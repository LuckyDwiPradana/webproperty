<?php

namespace App\Models;

use CodeIgniter\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ClientException;


class AgentModel extends Model
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

    public function getAllAgents()
    {
        $response = $this->client->get($this->baseUrl . 'allagents');
        $responseData = json_decode($response->getBody()->getContents(), true);
        if (isset($responseData['data'])) {
            return $responseData['data'];
        } else {
            return [];
        }
    }

public function createAgent($data)
{
    $multipartData = $this->prepareMultipartData($data);

    try {
        $response = $this->client->post($this->baseUrl . 'agent', [
            'multipart' => $multipartData,
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        return $responseData;
    } catch (ServerException $e) {
        throw $e;
    }
}

public function isEmailExists($email)
{
    try {
        $response = $this->client->get($this->baseUrl . 'agent', [
            'query' => ['email' => $email],
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        
        if (isset($responseData['data'])) {
            return !empty($responseData['data']);
        }
        
        return false;
    } catch (ClientException $e) {
        if ($e->getCode() === 404) {
            return false;
        }
        throw $e;
    }
}


  public function getAgent($id)
{
    $response = $this->client->get($this->baseUrl . 'agent/' . $id);
    $responseData = json_decode($response->getBody()->getContents(), true);
    
    if (isset($responseData['data'][0])) {
        return $responseData['data'][0];
    }
    
    return null;
}

  public function updateAgent($id, $data)
{
    // Tambahkan field '_method' dengan nilai 'PUT' ke dalam data
    $data['_method'] = 'PUT';

    // Cek apakah password kosong
    if (empty($data['password'])) {
        // Jika password kosong, hapus elemen 'password' dari $data
        unset($data['password']);
    }
    
    $multipartData = $this->prepareMultipartData($data);
    $response = $this->client->request('POST', $this->baseUrl . 'agent/' . $id, [
        'multipart' => $multipartData,
    ]);
    $responseData = json_decode($response->getBody()->getContents(), true);

    // Jika respons dari API memiliki struktur ['message' => '...', 'data' => [...]]
    if (isset($responseData['data'][0])) {
        // Jika terdapat file yang diunggah, hapus temporary file
        if (isset($data['agent_photo']) && is_file($data['agent_photo'])) {
            unlink($data['agent_photo']);
        }

        return $responseData['data'][0];
    }

    // Jika struktur respons tidak sesuai, kembalikan respons asli dari API
    return $responseData;
}

    public function deleteAgent($id)
    {
        $response = $this->client->delete($this->baseUrl . 'agent/' . $id);
        $responseData = json_decode($response->getBody()->getContents(), true);
        return $responseData;
    }

    private function prepareMultipartData($data)
    {
        $multipartData = [];
        foreach ($data as $key => $value) {
            if ($key === 'agent_photo') {
                $multipartData[] = [
                    'name' => 'agent_photo',
                    'contents' => file_get_contents($value),
                    'filename' => basename($value),
                ];
            } else {
                $multipartData[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }
        return $multipartData;
    }
}