<?php

namespace App\Controllers;
use App\Models\AgentPropertyModel;
use App\Models\AgentShowingModel;
use App\Models\AgentDealModel;
use CodeIgniter\HTTP\RedirectResponse;
use GuzzleHttp\Exception\ServerException;



class Agent extends BaseController
{
    private $propertyModel;
    private $showingModel;
    private $dealModel;

    public function __construct()
    {
        $this->propertyModel = new AgentPropertyModel();
        $this->showingModel = new AgentShowingModel();
        $this->dealModel = new AgentDealModel();
    }



    public function index()
    {
        $propertyModel = new AgentPropertyModel();
    $properties = $propertyModel->getAllProperties();
         if (!$properties) {
        $properties = [];
    }
     $showings = $this->showingModel->getAllShowings(); 
     $deals = $this->dealModel->getAllDeals(); 
        $data = [
            'logout_url' => '/auth/logout',
             'properties' => $properties,
             'showings' => $showings,
             'deals' => $deals,
        ];
        return view('agent/index', $data);
    }

   public function properties()
{
    $properties = $this->propertyModel->getAllProperties();
$logout_url = site_url('auth/logout');
    return view('agent/properties/index', ['properties' => $properties, 'logout_url' => $logout_url]);
}

public function detailProperty($id)
{
    $property = $this->propertyModel->getProperty($id);
    $logout_url = site_url('auth/logout');

    if (!$property) {
        return redirect()->to('/agent/properties')->with('error', 'Properti tidak ditemukan');
    }

    $data = [
        'property' => $property['property'],
        'logout_url' => $logout_url,
    ];

    return view('agent/properties/detail', $data);
}

public function createProperty()
{
$logout_url = site_url('auth/logout');
    return view('agent/properties/create', ['logout_url' => $logout_url]);
}

public function storeProperty()
{
    $data = $this->request->getPost();
    $files = $this->request->getFiles();
    if (!empty($files['photos'])) {
        $data['photos'] = $files['photos'];
    }

    $response = $this->propertyModel->createProperty($data);

   if ($response) {
        session()->setFlashdata('success', 'Property berhasil ditambahkan.');
        return redirect()->to('/agent/properties/index');
    } else {
        session()->setFlashdata('error', 'Terjadi kesalahan saat menambahkan property.');
        return redirect()->back()->withInput();
    }
}

public function showProperty($id)
{
    $property = $this->propertyModel->getProperty($id);
    if (!empty($property)) {
        $imageUrl = $this->propertyModel->getPropertyImageUrl($id);
    $logout_url = site_url('auth/logout');
        return view('agent/properties/show', ['property' => $property['property'], 'imageUrl' => $imageUrl, 'logout_url' => $logout_url]);
    } else {
        return redirect()->to('/agent/properties')->with('error', 'Properti tidak ditemukan');
    }
}

public function editProperty($id)
{
    $property = $this->propertyModel->getProperty($id);
    if (isset($property['property'])) {
    $logout_url = site_url('auth/logout');
        return view('agent/properties/edit', ['property' => $property['property'], 'logout_url' => $logout_url]);
    } else {
        // Tangani kasus ketika properti tidak ditemukan
        return redirect()->to('/agent/properties/index')->with('error', 'Properti tidak ditemukan');
    }
}

public function updateProperty($id)
{
    $data = $this->request->getPost();
    $uploadedFiles = $this->request->getFiles();
    if (!empty($uploadedFiles['photos'])) {
        $data['photos'] = [];
        foreach ($uploadedFiles['photos'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $data['photos'][] = $file;
            }
        }
    }

    $response = $this->propertyModel->updateProperty($id, $data);

     if ($response) {
        session()->setFlashdata('success', 'Property berhasil diperbarui.');
    } else {
        session()->setFlashdata('error', 'Terjadi kesalahan saat memperbarui property.');
    }
    return redirect()->to('/agent/properties/index');
}


public function deleteProperty($id)
{
    $method = $this->request->getMethod(true);
    if ($method === 'DELETE') {
        $response = $this->propertyModel->deleteProperty($id);
        if ($response['success']) {
            session()->setFlashdata('success', $response['message']);
        } else {
            session()->setFlashdata('error', $response['message']);
        }
        return redirect()->to('/agent/properties/index');
    }
    
    session()->setFlashdata('error', 'Metode permintaan tidak valid');
    return redirect()->to('/agent/properties/index');
}

//showing
public function showings()
{
    $showings = $this->showingModel->getAllShowings();
$logout_url = site_url('auth/logout');
    return view('agent/showings/index', ['showings' => $showings, 'logout_url' => $logout_url]);
}

public function detailShowing($id)
{
    $showing = $this->showingModel->getShowing($id);
    $logout_url = site_url('auth/logout');

    if (!$showing) {
        return redirect()->to('/agent/showings/index')->with('error', 'Showing tidak ditemukan');
    }

    $data = [
        'showing' => $showing,
        'logout_url' => $logout_url,
    ];

    return view('agent/showings/detail', $data);
}

public function createShowing()
{
    $properties = $this->propertyModel->getAllProperties();
$logout_url = site_url('auth/logout');
    return view('agent/showings/create', [
        'properties' => $properties,
        'logout_url' => $logout_url
    ]);
}

public function storeShowing()
{
    $data = $this->request->getPost();
    $files = $this->request->getFiles();
    if (!empty($files['photos'])) {
        $data['photos'] = $files['photos'];
    }

    // Mendapatkan agent_id berdasarkan property_id yang dipilih
    $authAgentId = session()->get('agent_id');
    $data['agent_id'] = $authAgentId;

    $response = $this->showingModel->createShowing($data);

    if ($response) {
        session()->setFlashdata('success', 'Showing berhasil ditambahkan.');
        return redirect()->to('/agent/showings/index');
    } else {
        session()->setFlashdata('error', 'Terjadi kesalahan saat menambahkan Showing.');
        return redirect()->back()->withInput();
    }
}

public function showShowing($id)
{
    $showing = $this->showingModel->getShowing($id);
$logout_url = site_url('auth/logout');
    return view('agent/showings/show', ['showing' => $showing, 'logout_url' => $logout_url]);
}

public function editShowing($id)
{
    $showing = $this->showingModel->getShowing($id);
    $properties = $this->propertyModel->getAllProperties();
$logout_url = site_url('auth/logout');
    return view('agent/showings/edit', [
        'showing' => $showing,
        'properties' => $properties,
        'logout_url' => $logout_url
    ]);
}

public function updateShowing($id)
{
    $data = $this->request->getPost();
    $files = $this->request->getFiles();

    // Jika ada foto yang diunggah, hapus foto lama dan gunakan foto baru
    if (!empty($files['photos'])) {
        $data['photos'] = $files['photos'];
    }

    // Mendapatkan agent_id berdasarkan property_id yang dipilih
    $authAgentId = session()->get('agent_id');
    $data['agent_id'] = $authAgentId;

    $response = $this->showingModel->updateShowing($id, $data);

    if ($response) {
        session()->setFlashdata('success', 'Showing berhasil diperbarui.');
        return redirect()->to('/agent/showings/index');
    } else {
        session()->setFlashdata('error', 'Terjadi kesalahan saat memperbarui Showing.');
        return redirect()->back()->withInput();
    }
}

public function deleteShowing($id)
{
    $response = $this->showingModel->deleteShowing($id);
    if ($response) {
        session()->setFlashdata('success', 'Showing berhasil dihapus.');
    } else {
        session()->setFlashdata('error', 'Terjadi kesalahan saat menghapus Showing.');
    }
    return redirect()->to('/agent/showings/index');
}

//deal
public function deals()
{
    $deals = $this->dealModel->getAllDeals();
$logout_url = site_url('auth/logout');
    return view('agent/deals/index', ['deals' => $deals, 'logout_url' => $logout_url]);
}

public function showDeal($id)
{
    $deal = $this->dealModel->getDeal($id);
$logout_url = site_url('auth/logout');
    return view('agent/deals/show', ['deal' => $deal, 'logout_url' => $logout_url]);
}
}