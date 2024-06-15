<?php

namespace App\Models;

use CodeIgniter\Model;
use GuzzleHttp\Client;

class AgentDealModel extends Model
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
        $this->baseUrl = 'http://127.0.0.1:8000/api/agent/';
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
}