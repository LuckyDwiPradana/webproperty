<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use Config\Api;

class ApiClient
{
    protected $client;
    protected $apiConfig;
    protected $authToken;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiConfig = new Api();
        $this->authToken = session()->get('auth_token');
    }

    public function get($endpoint, $params = [])
    {
        $params['token'] = $this->authToken;
        return $this->makeRequest('GET', $endpoint, $params);
    }

    public function post($endpoint, $data = [])
    {
        $data['token'] = $this->authToken;
        return $this->makeRequest('POST', $endpoint, [], $data);
    }

    public function put($endpoint, $data = [])
    {
        $data['token'] = $this->authToken;
        return $this->makeRequest('PUT', $endpoint, [], $data);
    }

    public function delete($endpoint, $params = [])
    {
        $params['token'] = $this->authToken;
        return $this->makeRequest('DELETE', $endpoint, $params);
    }

    protected function makeRequest($method, $endpoint, $params = [], $data = [])
    {
        $url = $this->apiConfig->apiUrl . $endpoint;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => !empty($data) ? json_encode($data) : null,
        ];

        $response = $this->client->request($method, $url, $options);

        return json_decode($response->getBody(), true);
    }
}