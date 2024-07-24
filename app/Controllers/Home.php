<?php

namespace App\Controllers;
use App\Models\PublicModel;

class Home extends BaseController
{

        protected $publicModel;

    public function __construct()
    {
        $this->publicModel = new PublicModel();
    }

    public function index()
{
    $data['active'] = 'home/index';
    $propertiTerbaru = $this->publicModel->getPropertiTerbaru(3); 
    $propertiTerpopuler = $this->publicModel->getPropertiTerpopuler(3);

    // Ambil data agen untuk setiap properti
    foreach ($propertiTerbaru as &$properti) {
        $properti['agent'] = $this->publicModel->getAgentById($properti['agent_id']);
    }
    foreach ($propertiTerpopuler as &$properti) {
        $properti['agent'] = $this->publicModel->getAgentById($properti['agent_id']);
    }

    // Ambil semua gambar dari properti terbaru
    $latestPropertyImages = [];
    foreach ($propertiTerbaru as $properti) {
        if (!empty($properti['photos'])) {
            $latestPropertyImages = array_merge($latestPropertyImages, array_column($properti['photos'], 'url'));
        }
    }
    // Jika tidak ada gambar, gunakan gambar default
    if (empty($latestPropertyImages)) {
        $latestPropertyImages[] = base_url('temp/assets/images/bg_1.jpg');
    }

    $data['propertiTerbaru'] = $propertiTerbaru;
    $data['propertiTerpopuler'] = $propertiTerpopuler;
    $data['latestPropertyImages'] = $latestPropertyImages;
    return view('home/index', $data);
}

public function agents()
{
    $data['active'] = 'home/agents';
    $keyword = $this->request->getGet('keyword');
    $address = $this->request->getGet('address');
    $phone_number = $this->request->getGet('phone_number');

    // Get the current page from the URL, default to 1 if not set
    $page = (int)($this->request->getGet('page') ?? 1);

    // Set items per page
    $perPage = 6;

    // Get all agents
    $allAgents = $this->publicModel->searchAgents($keyword, $address, $phone_number);
    $totalAgents = count($allAgents);
 
    // Calculate total pages
    $totalPages = ceil($totalAgents / $perPage);

    // Ensure current page is within valid range
    $page = max(1, min($page, $totalPages));

    // Calculate offset
    $offset = ($page - 1) * $perPage;

    // Get paginated agents
    $data['agents'] = array_slice($allAgents, $offset, $perPage);

    // Pass search parameters and pagination data to the view
    $data['keyword'] = $keyword;
    $data['address'] = $address;
    $data['phone_number'] = $phone_number;
    $data['currentPage'] = $page;
    $data['totalPages'] = $totalPages;
    $data['totalAgents'] = $totalAgents;

    return view('home/agents', $data);
}

public function properties()
    {
        $data['active'] = 'home/properties';
        $keyword = $this->request->getGet('keyword');
        $type = $this->request->getGet('type');
        $min_price = $this->request->getGet('min_price');
        $max_price = $this->request->getGet('max_price');
        $location = $this->request->getGet('location');
        $area = $this->request->getGet('area');
        $sort = $this->request->getGet('sort');

        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = 6;

        $allProperties = $this->publicModel->searchProperties($keyword, $type, $min_price, $max_price, $location, $area);

        if ($sort === 'newest') {
            usort($allProperties, function ($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
            });
        } elseif ($sort === 'popular') {
            // Implementasikan logika pengurutan berdasarkan popularitas di sini
        }

        $totalProperties = count($allProperties);
        $totalPages = ceil($totalProperties / $perPage);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        $data['properties'] = array_slice($allProperties, $offset, $perPage);

        foreach ($data['properties'] as &$property) {
            if (isset($property['agent_id'])) {
                $agent = $this->publicModel->getAgentById($property['agent_id']);
                $property['agent'] = $agent;
            }
        }

        $data['keyword'] = $keyword;
        $data['type'] = $type;
        $data['min_price'] = $min_price;
        $data['max_price'] = $max_price;
        $data['location'] = $location;
        $data['area'] = $area;
        $data['sort'] = $sort;
        $data['currentPage'] = $page;
        $data['totalPages'] = $totalPages;
        $data['totalProperties'] = $totalProperties;

        return view('home/properties', $data);
    }

    public function info()
    {
         $data['active'] = 'home/info';
        return view('home/info');
    }

    public function kpr()
    {
         $data['active'] = 'home/kpr';
        return view('home/kpr');
    }

public function agent_info($id)
{
    $agent = $this->publicModel->getAgentById($id);
    
    if (!$agent) {
        return 'Agen tidak ditemukan';
    }

    // Ambil parameter pencarian
    $keyword = $this->request->getGet('keyword');

    // Ambil nomor halaman dari URL, default ke 1 jika tidak diset
    $page = (int)($this->request->getGet('page') ?? 1);

    // Set jumlah item per halaman
    $perPage = 6;

    // Ambil properti untuk agen ini dengan kriteria pencarian
    $allProperties = $this->publicModel->searchPropertiesByAgent($id, $keyword);

      // Sort properties by creation date in descending order
    usort($allProperties, function ($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });

    $totalProperties = count($allProperties);

    // Hitung total halaman
    $totalPages = ceil($totalProperties / $perPage);

    // Pastikan halaman saat ini dalam rentang yang valid
    $page = max(1, min($page, $totalPages));

    // Hitung offset
    $offset = ($page - 1) * $perPage;

    // Ambil properti yang sudah dipaginasi
    $properties = array_slice($allProperties, $offset, $perPage);

    $data = [
        'agent' => $agent,
        'properties' => $properties,
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'totalProperties' => $totalProperties,
        'keyword' => $keyword,
    ];

    return view('home/agent_info', $data);
}

 public function properties_info($id)
    {
        $properties = $this->publicModel->getAllProperties();
        $property = null;
        
        foreach ($properties as $prop) {
            if ($prop['id'] == $id) {
                $property = $prop;
                break;
            }
        }
        
        if (empty($property)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        // Fetch agent information
        if (isset($property['agent_id'])) {
            $property['agent'] = $this->publicModel->getAgentById($property['agent_id']);
        }
        
        $data['property'] = $property;
        return view('home/properties_info', $data);
    }
}
