<?php

namespace App\Controllers;

use App\Models\PropertyModel;
use App\Models\AgentModel;
use App\Models\ShowingModel;
use App\Models\DealModel;
use CodeIgniter\HTTP\RedirectResponse;
use GuzzleHttp\Exception\ServerException;

class Admin extends BaseController
{
    private $propertyModel;
     private $dealModel;

    public function __construct()
    {
        $this->propertyModel = new PropertyModel();
        $this->agentModel = new AgentModel();
         $this->showingModel = new ShowingModel();
          $this->dealModel = new DealModel();
          
    }

    public function index()
    {
        $propertyModel = new PropertyModel();
    $properties = $propertyModel->getAllProperties();
         if (!$properties) {
        $properties = [];
    }
     $agents = $this->agentModel->getAllAgents(); 
     $showings = $this->showingModel->getAllShowings(); 
     $deals = $this->dealModel->getAllDeals(); 
        $data = [
            'logout_url' => '/auth/logout',
             'properties' => $properties,
             'agents' => $agents,
             'showings' => $showings,
             'deals' => $deals,
        ];
        return view('admin/index', $data);
    }

public function properties()
{
    $propertyModel = new PropertyModel();
    $properties = $propertyModel->getAllProperties();
    $propertiesWithImageUrl = [];
    foreach ($properties as $property) {
        $imageUrl = $propertyModel->getPropertyImageUrl($property['id']);
        $propertiesWithImageUrl[] = array_merge($property, ['imageUrl' => $imageUrl]);
    }
    $logout_url = route_to('Auth::logout'); // Definisikan rute logout

    return view('admin/properties/index', [
        'properties' => $propertiesWithImageUrl,
        'logout_url' => $logout_url // Kirimkan $logout_url ke view
    ]);
}

public function createProperty()
{
    $logout_url = route_to('Auth::logout');
    return view('admin/properties/create', ['logout_url' => $logout_url]);
}

public function storeProperty()
{
    $data = $this->request->getPost();
    $files = $this->request->getFiles();
    if (!empty($files['photos'])) {
        $data['photos'] = $files['photos'];
    }

    // Log data sebelum dikirim ke model
    log_message('debug', 'Data yang diterima di storeProperty: ' . print_r($data, true));

    $response = $this->propertyModel->createProperty($data);

    // Log response dari createProperty
    log_message('debug', 'Response dari createProperty: ' . print_r($response, true));

    if ($response) {
        return redirect()->to('/admin/properties/index');
    } else {
        return redirect()->back()->withInput();
    }
}



public function showProperty($id)
{
    $property = $this->propertyModel->getProperty($id);
    $imageUrl = $this->propertyModel->getPropertyImageUrl($id);
    $logout_url = route_to('Auth::logout');

    return view('properties/index', ['property' => $property, 'imageUrl' => $imageUrl, 'logout_url' => $logout_url]);
}

public function editProperty($id)
{
    $property = $this->propertyModel->getProperty($id);
    $logout_url = route_to('Auth::logout');
    return view('admin/properties/edit', ['property' => $property, 'logout_url' => $logout_url]);
}

public function updateProperty($id)
{
    $propertyModel = new PropertyModel();
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

    $response = $propertyModel->updateProperty($id, $data);

    if ($response) {
        session()->setFlashdata('success', 'Property berhasil diperbarui.');
    } else {
        session()->setFlashdata('error', 'Terjadi kesalahan saat memperbarui property.');
    }

    return redirect()->to('/admin/properties/index');
}


public function deleteProperty($id)
{
    $method = $this->request->getMethod(true);
    if ($method === 'DELETE') {
        $response = $this->propertyModel->deleteProperty($id);
        if ($response === true) {
            // Properti berhasil dihapus
            // Ambil daftar properti terbaru setelah menghapus
            $properties = $this->propertyModel->getAllProperties();
            $logout_url = route_to('Auth::logout');
            return view('admin/properties/index', ['properties' => $properties, 'success' => 'Property berhasil dihapus', 'logout_url' => $logout_url]);
        } else {
            // Terjadi kesalahan
            $errorMessage = isset($response['message']) ? $response['message'] : 'Terjadi kesalahan saat menghapus properti.';
            // Ambil daftar properti terbaru setelah gagal menghapus
            $properties = $this->propertyModel->getAllProperties();
            $logout_url = route_to('Auth::logout');
            return view('admin/properties/index', ['properties' => $properties, 'error' => $errorMessage, 'logout_url' => $logout_url]);
        }
    } else {
        // Metode permintaan tidak valid
        return $this->response->setStatusCode(405)->setJSON(['error' => 'Metode permintaan tidak valid']);
    }
}

public function agents()
{
    $agentModel = new AgentModel();
    $agents = $agentModel->getAllAgents();
    $logout_url = route_to('Auth::logout');

    return view('admin/agents/index', ['agents' => $agents, 'logout_url' => $logout_url]);
}

public function createAgent()
{
    $logout_url = route_to('Auth::logout');
    return view('admin/agents/create', ['logout_url' => $logout_url]);
}



public function storeAgent()
{
    // Membuat instance model AgentModel
    $agentModel = new AgentModel();

    // Mengambil data dari permintaan
    $data = $this->request->getPost();

    // Memeriksa validitas file foto agent
    if ($this->request->getFile('agent_photo')->isValid()) {
        $data['agent_photo'] = $this->request->getFile('agent_photo')->getTempName();
    }

    // Validasi email
    $email = $data['email'];
    if ($agentModel->isEmailExists($email)) {
        return redirect()->back()->withInput()->with('error', 'Email sudah digunakan.');
    }

    try {
        // Mencoba membuat agent baru
        $response = $agentModel->createAgent($data);

        if ($response) {
            // Agent berhasil dibuat, set pesan sukses di session flashdata
            session()->setFlashdata('success', 'Agent berhasil dibuat.');
            return redirect()->to('/admin/agents/index');
        } else {
            return redirect()->back()->withInput();
        }
    } catch (ServerException $e) {
        $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
        $errorMessage = $errorResponse['error'] ?? 'Terjadi kesalahan server';
        return redirect()->back()->withInput()->with('error', $errorMessage);
    }
}


public function editAgent($id)
{
    $agentModel = new AgentModel();
    $agent = $agentModel->getAgent($id);

    if ($agent === null) {
        // Agent tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
        return redirect()->to('/admin/agents')->with('error', 'Agent tidak ditemukan.');
    }

    $logout_url = route_to('Auth::logout');
    return view('admin/agents/edit', ['agent' => $agent, 'logout_url' => $logout_url]);
}

public function updateAgent($id)
{
    $agentModel = new AgentModel();
    $data = $this->request->getPost();

    // Memeriksa validitas file foto agent
    if ($this->request->getFile('agent_photo')->isValid()) {
        $data['agent_photo'] = $this->request->getFile('agent_photo')->getTempName();
    }

    // Validasi email
    $email = $data['email'];
    $currentAgent = $agentModel->getAgent($id);
    if ($email !== $currentAgent['email'] && $agentModel->isEmailExists($email)) {
        return redirect()->back()->withInput()->with('error', 'Email sudah digunakan.');
    }

    try {
        // Mencoba memperbarui data agent
        $response = $agentModel->updateAgent($id, $data);

        if ($response !== null) {
            session()->setFlashdata('success', 'Data agent berhasil diperbarui.');
            return redirect()->to('/admin/agents/index');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data agent.');
        }
    } catch (ServerException $e) {
        $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
        $errorMessage = $errorResponse['error'] ?? 'Terjadi kesalahan server';
        return redirect()->back()->withInput()->with('error', $errorMessage);
    }
}

public function deleteAgent($id)
{
    $agentModel = new AgentModel();
    $method = $this->request->getMethod(true); // Dapatkan metode HTTP yang sebenarnya

    if ($method === 'DELETE') {
        $response = $agentModel->deleteAgent($id);
        if (isset($response['status']) && $response['status'] === 'success') {
            // Agent berhasil dihapus
            $logout_url = route_to('Auth::logout');
            return redirect()->to('/admin/agents/index')->with('success', 'Agent berhasil dihapus')->with('logout_url', $logout_url);
        } else {
            // Terjadi kesalahan
            $errorMessage = isset($response['message']) ? $response['message'] : 'Terjadi kesalahan saat menghapus agent.';
            $logout_url = route_to('Auth::logout');
            return redirect()->to('/admin/agents/index')->with('error', $errorMessage)->with('logout_url', $logout_url);
        }
    } else {
        // Metode permintaan tidak valid
        return $this->response->setStatusCode(405)->setJSON(['error' => 'Metode permintaan tidak valid']);
    }
}

//UNTUK SHOWING 

    public function showings()
    {
        $showings = $this->showingModel->getAllShowings();
        return view('admin/showings/index', ['showings' => $showings]);
    }

    
   public function createShowing()
{
    $propertyModel = new PropertyModel();
    $properties = $propertyModel->getAllProperties();

    return view('admin/showings/create', [
        'properties' => $properties
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
    $propertyModel = new PropertyModel();
    $property = $propertyModel->getProperty($data['property_id']);
    $data['agent_id'] = $property['agent_id'];

    $response = $this->showingModel->createShowing($data);

    if ($response) {
        return redirect()->to('/admin/showings/index');
    } else {
        return redirect()->back()->withInput();
    }
}


    public function showShowing($id)
    {
        $showing = $this->showingModel->getShowing($id);
        return view('admin/showings/show', ['showing' => $showing]);
    }

public function editShowing($id)
{
    $showing = $this->showingModel->getShowing($id);
    $propertyModel = new PropertyModel();
    $properties = $propertyModel->getAllProperties();

    return view('admin/showings/edit', [
        'showing' => $showing,
        'properties' => $properties
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
    $propertyModel = new PropertyModel();
    $property = $propertyModel->getProperty($data['property_id']);
    $data['agent_id'] = $property['agent_id'];

    $response = $this->showingModel->updateShowing($id, $data);

    if ($response) {
        return redirect()->to('/admin/showings/index')->with('success', 'Showing berhasil diperbarui');
    } else {
        return redirect()->back()->withInput()->with('errors', ['Terjadi kesalahan saat memperbarui Showing']);
    }
}

    public function deleteShowing($id)
    {
        $response = $this->showingModel->deleteShowing($id);
        return redirect()->to('/admin/showings/index');
    }


//deal
    public function deals()
    {
        $deals = $this->dealModel->getAllDeals();
        // dd($deals);
        return view('admin/deals/index', ['deals' => $deals]);
    }

    public function showDeal($id)
    {
        $deal = $this->dealModel->getDeal($id);
        return view('admin/deals/show', ['deal' => $deal]);
    }

    public function createDeal()
    {
        $propertyModel = new PropertyModel();
        $properties = $propertyModel->getAllProperties();

        return view('admin/deals/create', [
            'properties' => $properties
        ]);
    }

    public function storeDeal()
    {
        $data = $this->request->getPost();
        $documentation = $this->request->getFile('documentation');
        if ($documentation && $documentation->isValid()) {
            $data['documentation'] = $documentation;
        }

        // Mendapatkan agent_id berdasarkan property_id yang dipilih
        $propertyModel = new PropertyModel();
        $property = $propertyModel->getProperty($data['property_id']);
        $data['agent_id'] = $property['agent_id'];

        $success = $this->dealModel->createDeal($data);
        if ($success) {
            return redirect()->to('/admin/deals/index')->with('success', 'Deal created successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to create deal');
        }
    }

    public function editDeal($id)
    {
        $deal = $this->dealModel->getDeal($id);
        $propertyModel = new PropertyModel();
        $properties = $propertyModel->getAllProperties();

        return view('admin/deals/edit', [
            'deal' => $deal,
            'properties' => $properties
        ]);
    }

    public function updateDeal($id)
    {
        $data = $this->request->getPost();
        $documentation = $this->request->getFile('documentation');
        if ($documentation && $documentation->isValid()) {
            $data['documentation'] = $documentation;
        }

        // Mendapatkan agent_id berdasarkan property_id yang dipilih
        $propertyModel = new PropertyModel();
        $property = $propertyModel->getProperty($data['property_id']);
        $data['agent_id'] = $property['agent_id'];

        $success = $this->dealModel->updateDeal($id, $data);
        if ($success) {
            return redirect()->to('/admin/deals/index')->with('success', 'Deal updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update deal');
        }
    }

    public function deleteDeal($id)
    {
        $result = $this->dealModel->deleteDeal($id);
        if ($result['message'] === 'Deal deleted successfully') {
            return redirect()->to('/admin/deals/index')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', 'Failed to delete deal');
        }
    }
    }