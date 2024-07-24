<?php

namespace App\Models;

use CodeIgniter\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PublicModel extends Model
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/api/',
        ]);
    }

    public function getAllAgents()
    {
        try {
            $response = $this->client->get('public/agents');
            return json_decode($response->getBody()->getContents(), true)['data'];
        } catch (RequestException $e) {
            // Handle request error
            return [];
        }
    }

    public function getAllProperties()
    {
        try {
            $response = $this->client->get('public/properties');
            return json_decode($response->getBody()->getContents(), true)['properties'];
        } catch (RequestException $e) {
            // Handle request error
            return [];
        }
    }

     public function getPropertiesByAgent($agentId)
    {
        try {
            $response = $this->client->get("public/agents/{$agentId}/properties");
            return json_decode($response->getBody()->getContents(), true)['properties'];
        } catch (RequestException $e) {
            // Handle request error
            return [];
        }
    }

    public function getAgentById($id)
{
    try {
        $response = $this->client->get("public/agents/{$id}");
        return json_decode($response->getBody()->getContents(), true)['data'];
    } catch (RequestException $e) {
        // Handle request error
        return null;
    }
}
   public function searchProperties($keyword = null, $type = null, $min_price = null, $max_price = null, $location = null, $area = null)
{
    try {
        $query = [
            'keyword' => $keyword,
            'type' => $type,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'location' => $location,
            'area' => $area,
        ];

        $response = $this->client->get('public/properties/search', [
            'query' => array_filter($query) // Remove null values
        ]);

        return json_decode($response->getBody()->getContents(), true)['properties'];
    } catch (RequestException $e) {
        // Handle request error
        return [];
    }
}

   public function searchAgents($keyword = null, $address = null, $phone_number = null)
{
    try {
        $query = [
            'keyword' => $keyword,
            'address' => $address,
            'phone_number' => $phone_number,
        ];

        $response = $this->client->get('public/agents/search', [
            'query' => array_filter($query) // Remove null values
        ]);

        return json_decode($response->getBody()->getContents(), true)['data'];
    } catch (RequestException $e) {
        // Handle request error
        return [];
    }
}

  public function searchPropertiesByAgent($agentId, $keyword = null)
{
    $properties = $this->getPropertiesByAgent($agentId);

    // Filter properti berdasarkan kriteria pencarian
    return array_filter($properties, function($property) use ($keyword) {
        if (!$keyword) {
            return true;
        }

        $searchFields = [
            $property['name'],
            $property['description'],
            $property['property_type'],
            $property['location'],
            $property['area'],
            number_format($property['price'], 0, ',', '.')
        ];

        foreach ($searchFields as $field) {
            if (stripos($field, $keyword) !== false) {
                return true;
            }
        }

        return false;
    });
}

public function getPropertiTerbaru($limit = 3)
    {
        $properties = $this->getAllProperties();
        usort($properties, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        return array_slice($properties, 0, $limit);
    }

    public function getPropertiTerpopuler($limit = 3)
    {
        // Ini adalah placeholder. Implementasikan logika popularitas Anda sendiri.
        $properties = $this->getAllProperties();
        // Contoh sederhana: urutkan berdasarkan jumlah dilihat (jika ada field 'view_count')
        usort($properties, function($a, $b) {
            return ($b['view_count'] ?? 0) - ($a['view_count'] ?? 0);
        });
        return array_slice($properties, 0, $limit);
    }
    
}