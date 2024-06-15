<?php

namespace App\Models;

use CodeIgniter\Model;
use GuzzleHttp\Client;

class ShowingModel extends Model
{
    private $client;
    private $baseUrl;

    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get('auth_token'),
            ],
        ]);
        $this->baseUrl = 'http://127.0.0.1:8000/api/admin/';
    }

    public function getAllShowings()
    {
        $response = $this->client->get($this->baseUrl . 'allshowings');
        $showings = json_decode($response->getBody()->getContents(), true);
        return $showings['showings'];
    }

    public function getShowing($id)
    {
        $response = $this->client->get($this->baseUrl . 'showing/' . $id);
        $showing = json_decode($response->getBody()->getContents(), true);
        return $showing['showing'];
    }

    public function createShowing($data)
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
            $response = $this->client->post($this->baseUrl . 'showing', [
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

public function updateShowing($id, $data)
{
    $multipart = [];
    foreach ($data as $key => $value) {
        if ($key === 'photos' && is_array($value)) {
            foreach ($value as $photo) {
                if ($photo instanceof \CodeIgniter\Files\File && $photo->isValid()) {
                    $multipart[] = [
                        'name' => 'photos[]',
                        'contents' => fopen($photo->getTempName(), 'r'),
                        'filename' => $photo->getName(),
                        'headers' => [
                            'Content-Type' => $photo->getMimeType()
                        ]
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
        $response = $this->client->post($this->baseUrl . 'showing/' . $id, [
            'multipart' => $multipart
        ]);
        $result = json_decode($response->getBody()->getContents(), true);

        // Log respons dari API
        log_message('debug', 'Response dari updateShowing: ' . print_r($result, true));

        return true; // Mengembalikan true jika berhasil diperbarui
    } catch (\Exception $e) {
        // Log kesalahan
        log_message('error', 'Terjadi kesalahan: ' . $e->getMessage());
        return false;
    }
}
    public function deleteShowing($id)
    {
        $response = $this->client->delete($this->baseUrl . 'showing/' . $id);
        return json_decode($response->getBody()->getContents(), true);
    }
}
