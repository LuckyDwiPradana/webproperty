<?php

namespace App\Models;

use CodeIgniter\Model;
use GuzzleHttp\Client;

class DealModel extends Model
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

    public function getAllDeals()
    {
        $response = $this->client->get($this->baseUrl . 'alldeals');
        $deals = json_decode($response->getBody()->getContents(), true);
        return $deals['deal'];
    }

    public function getDeal($id)
    {
        $response = $this->client->get($this->baseUrl . 'deal/' . $id);
        $deal = json_decode($response->getBody()->getContents(), true);
        return $deal['deal'];
    }

public function createDeal($data)
{
    $documentation = null;
    if (isset($data['documentation']) && is_object($data['documentation'])) {
        $documentation = $data['documentation'];
        unset($data['documentation']);
    }

    $multipart = [];
    foreach ($data as $key => $value) {
        $multipart[] = [
            'name' => $key,
            'contents' => $value
        ];
    }

    if ($documentation !== null) {
        $multipart[] = [
            'name' => 'documentation',
            'contents' => fopen($documentation->getTempName(), 'r'),
            'filename' => $documentation->getName(),
            'headers' => [
                'Content-Type' => $documentation->getMimeType()
            ]
        ];
    }

    try {
        $response = $this->client->post($this->baseUrl . 'deal', [
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


    public function updateDeal($id, $data)
    {
        $documentation = null;
        if (isset($data['documentation']) && is_object($data['documentation'])) {
            $documentation = $data['documentation'];
            unset($data['documentation']);
        }

        $multipart = [];
        foreach ($data as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => $value
            ];
        }

        if ($documentation !== null) {
            $multipart[] = [
                'name' => 'documentation',
                'contents' => fopen($documentation->getTempName(), 'r'),
                'filename' => $documentation->getName(),
                'headers' => [
                    'Content-Type' => $documentation->getMimeType()
                ]
            ];
        }

        try {
            $response = $this->client->post($this->baseUrl . 'deal/' . $id, [
                'multipart' => $multipart
            ]);
            $result = json_decode($response->getBody()->getContents(), true);

            // Log respons dari API
            log_message('debug', 'Response dari updateDeal: ' . print_r($result, true));

            return true; // Mengembalikan true jika berhasil diperbarui
        } catch (\Exception $e) {
            // Log kesalahan
            log_message('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteDeal($id)
    {
        $response = $this->client->delete($this->baseUrl . 'deal/' . $id);
        return json_decode($response->getBody()->getContents(), true);
    }
}