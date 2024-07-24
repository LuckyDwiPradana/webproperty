<?php

namespace App\Models;

use CodeIgniter\Model;
use GuzzleHttp\Client;

class AgentPropertyModel extends Model
{
    private $client;
    private $baseUrl;

    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get('token'),
            ],
        ]);
        $this->baseUrl = 'http://127.0.0.1:8000/api/agent/';
    }

    public function getPropertyImageUrl($id)
    {
        $response = $this->client->get($this->baseUrl . 'property/' . $id);
        $property = json_decode($response->getBody()->getContents(), true);
        if (isset($property['property']['photo_urls'])) {
            return $property['property']['photo_urls'];
        } else {
            return [];
        }
    }

    public function getAllProperties()
    {
        $response = $this->client->get($this->baseUrl . 'allproperties');
        $properties = json_decode($response->getBody()->getContents(), true);
        // dd($properties);
        return $properties['properties'];
    }

    
    public function createProperty($data)
    {
        $photos = [];
        if (isset($data['photos']) && is_array($data['photos'])) {
            $photos = $data['photos'];
            unset($data['photos']);
        }

        $multipart = [];
        foreach ($data as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value
            ];
        }

        foreach ($photos as $photo) {
            $multipart[] = [
                'name' => 'photos[]',
                'contents' => fopen($photo->getTempName(), 'r'),
                'filename' => $photo->getName(),
                'headers' => [
                    'Content-Type' => $photo->getMimeType()
                ]
            ];
        }

        try {
            $response = $this->client->post($this->baseUrl . 'property', [
                'multipart' => $multipart
            ]);
            $result = json_decode($response->getBody()->getContents(), true);

            return true;
        } catch (\Exception $e) {
            log_message('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return false;
        }
    }

    public function getProperty($id)
    {
        $response = $this->client->get($this->baseUrl . 'property/' . $id);
        $property = json_decode($response->getBody()->getContents(), true);
        if (isset($property['property'])) {
            return $property;
        }
        return [];
    }

    public function updateProperty($id, $data)
    {
        $multipart = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $subValue) {
                    if (is_object($subValue) && $subValue instanceof \CodeIgniter\Files\File) {
                        $multipart[] = [
                            'name' => 'photos[]',
                            'contents' => fopen($subValue->getTempName(), 'r'),
                            'filename' => $subValue->getClientName()
                        ];
                    } else {
                        $multipart[] = [
                            'name' => $key . '[]',
                            'contents' => $subValue
                        ];
                    }
                }
            } else {
                $multipart[] = [
                    'name' => $key,
                    'contents' => $value
                ];
            }
        }

        try {
            $response = $this->client->post($this->baseUrl . 'property/' . $id, [
                'multipart' => $multipart
            ]);
            $result = json_decode($response->getBody()->getContents(), true);

            return isset($result['message']) && $result['message'] === 'Property updated successfully';
        } catch (\Exception $e) {
            log_message('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteProperty($id)
{
    try {
        $response = $this->client->delete($this->baseUrl . 'property/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);

        if (isset($result['success']) && $result['success'] === true) {
            // Jika API berhasil menghapus, hapus foto lokal jika ada
            if (isset($result['data']['photos']) && is_array($result['data']['photos'])) {
                $this->deleteLocalPhotos($result['data']['photos']);
            }
            return [
                'success' => true,
                'message' => $result['message'] ?? 'Property berhasil dihapus.'
            ];
        } else {
            return [
                'success' => false,
                'message' => $result['message'] ?? 'Gagal menghapus properti.'
            ];
        }
    } catch (\Exception $e) {
        log_message('error', 'Error deleting property: ' . $e->getMessage());
        return [
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ];
    }
}

private function deleteLocalPhotos($photos)
{
    foreach ($photos as $photo) {
        if (!isset($photo['url'])) continue;

        $filename = basename($photo['url']);
        $filePath = FCPATH . 'storage/properties/' . $filename;

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                log_message('info', 'File deleted: ' . $filePath);
            } else {
                log_message('error', 'Failed to delete file: ' . $filePath);
            }
        } else {
            log_message('warning', 'File not found: ' . $filePath);
        }
    }
}
}