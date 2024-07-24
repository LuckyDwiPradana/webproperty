<?php

namespace App\Models;

use CodeIgniter\Model;
use GuzzleHttp\Client;

class PropertyModel extends Model
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
        $this->baseUrl = 'http://127.0.0.1:8000/api/admin/';
    }

    public function getPropertyImageUrl($id)
    {
        $response = $this->client->get($this->baseUrl . 'property/' . $id);
        $property = json_decode($response->getBody()->getContents(), true);
        if (isset($property['property']['photo_url'])) {
            return $property['property']['photo_url'];
        } else {
            return '';
        }
    }

    public function getAllProperties()
    {
        $response = $this->client->get($this->baseUrl . 'allproperties');
        $properties = json_decode($response->getBody()->getContents(), true);
        return $properties['properties'];
    }

    public function getAllAgents()
    {
        $response = $this->client->get($this->baseUrl . 'allagents');
        $agents = json_decode($response->getBody()->getContents(), true);
        return $agents['data'];
    }

 public function storePhotos($propertyId, $photos)
{
    $uploadedPhotos = [];
    foreach ($photos as $photo) {
        $path = $photo->store('properties', 'public');
        $uploadedPhotos[] = [
            'property_id' => $propertyId,
            'path' => $path,
            'url' => base_url('storage/' . $path),
        ];
    }

    $response = $this->client->post($this->baseUrl . 'property/' . $propertyId . '/photos', [
        'form_params' => [
            'photos' => json_encode($uploadedPhotos),
        ],
        'headers' => [
            'Content-Type' => 'application/json',
        ],
    ]);

    return json_decode($response->getBody()->getContents(), true);
}

public function createProperty($data) {
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

        // Log respons dari API
        log_message('debug', 'Respons dari API: ' . print_r($result, true));

        return true; // Indikator berhasil
    } catch (\Exception $e) {
        // Log kesalahan
        log_message('error', 'Terjadi kesalahan: ' . $e->getMessage());
        return false; // Indikator gagal
    }
}

    public function getProperty($id)
    {
        $response = $this->client->get($this->baseUrl . 'property/' . $id);
        $property = json_decode($response->getBody()->getContents(), true);
        return $property['property'];
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

        // Log respons dari API
        log_message('debug', 'Response dari updateProperty: ' . print_r($result, true));

        return isset($result['message']) && $result['message'] === 'Property updated successfully';
    } catch (\Exception $e) {
        // Log kesalahan
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
            // Jika API berhasil menghapus, hapus foto lokal
            if (isset($result['data']['photos']) && is_array($result['data']['photos'])) {
                $this->deleteLocalPhotos($result['data']['photos']);
            } else {
                log_message('warning', 'No photos data found or invalid format');
            }
            return [
                'success' => true,
                'message' => $result['message']
            ];
        } else {
            return [
                'success' => false,
                'message' => isset($result['message']) ? $result['message'] : 'Gagal menghapus properti'
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
    if (!is_array($photos)) {
        log_message('error', 'Photos data is not an array');
        return;
    }

    foreach ($photos as $photo) {
        if (!is_array($photo) || !isset($photo['url'])) {
            log_message('error', 'Invalid photo data structure');
            continue;
        }

        // Ekstrak nama file dari URL
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
