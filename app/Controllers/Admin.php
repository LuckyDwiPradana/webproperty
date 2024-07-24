<?php

namespace App\Controllers;

use App\Models\PropertyModel;
use App\Models\AgentModel;
use App\Models\ShowingModel;
use App\Models\DealModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RedirectResponse;
use GuzzleHttp\Exception\ServerException;



class Admin extends BaseController
{
    use ResponseTrait;
    public $propertyModel;
    private $agentModel;
    private $showingModel;
public $dealModel;

    public function __construct()
    {
        $this->propertyModel = new PropertyModel();
        $this->agentModel = new AgentModel();
        $this->showingModel = new ShowingModel();
        $this->dealModel = new DealModel();
    }

   private function makeApiRequest($url, $method, $data = null)
{
    $client = \Config\Services::curlrequest();

    try {
        $response = $client->request($method, $url, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session()->get('auth_token'),
            ],
            'form_params' => $data,
        ]);

        if ($response->getStatusCode() === 401) {
            session()->remove('auth_token');
            session()->setFlashdata('warning', 'Session telah kedaluwarsa. Anda akan diarahkan ke halaman login.');
            return redirect()->to('/login');
        }

        return json_decode($response->getBody(), true);
    } catch (ServerException $e) {
        $statusCode = $e->getResponse()->getStatusCode();
        $errorMessage = json_decode($e->getResponse()->getBody()->getContents(), true)['message'] ?? $e->getMessage();
        
        $formattedError = "GuzzleHttp\Exception\ServerException #{$statusCode}\n";
        $formattedError .= "Server error: `{$method} {$url}` ";
        $formattedError .= "resulted in a `{$statusCode} Internal Server Error` response: ";
        $formattedError .= json_encode(['status' => 'error', 'message' => $errorMessage]);

        log_message('error', $formattedError);

        return $this->fail($formattedError, $statusCode);
    } catch (\Exception $e) {
        log_message('error', $e->getMessage());
        return $this->fail('Terjadi kesalahan saat melakukan permintaan ke API.', 500);
    }
}

 public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        $this->propertyModel = model(PropertyModel::class);
        $this->agentModel = model(AgentModel::class);
        $this->showingModel = model(ShowingModel::class);
        $this->dealModel = model(DealModel::class);
    }

public function index()
{
    try {
        log_message('debug', 'Memulai permintaan data untuk dashboard');

        // Ambil data properties
        $properties = $this->propertyModel->getAllProperties();
        
        // Ambil data agents
        $agents = $this->agentModel->getAllAgents();
        
        // Ambil data showings
        $showings = $this->showingModel->getAllShowings();
        
        // Ambil data deals
        $deals = $this->dealModel->getAllDeals();

        $data = [
            'title' => 'Dashboard',
            'logout_url' => '/auth/logout',
            'properties' => $properties,
            'agents' => $agents,
            'showings' => $showings,
            'deals' => $deals,
        ];

        return view('admin/index', $data);

    } catch (\Exception $e) {
        log_message('error', 'Exception in index: ' . $e->getMessage());
        
        // Log the detailed error for debugging purposes
        log_message('error', $e->getTraceAsString());

        // Prepare a user-friendly error message
        $errorMessage = 'Terjadi kesalahan saat memuat data dashboard. Silakan coba lagi nanti atau hubungi administrator.';

        // Return the error_500 view with a user-friendly message
        return view('errors/html/error_500', ['message' => $errorMessage]);
    }
}

    public function properties()
    {
        $properties = $this->propertyModel->getAllProperties();
        $propertiesWithImageUrl = [];
        foreach ($properties as $property) {
            $imageUrl = $this->propertyModel->getPropertyImageUrl($property['id']);
            $propertiesWithImageUrl[] = array_merge($property, ['imageUrl' => $imageUrl]);
        }
        $logout_url = site_url('auth/logout');

        $data = [
            'properties' => $propertiesWithImageUrl,
            'logout_url' => $logout_url,
        ];

        return $this->response->setBody(view('admin/properties/index', $data));
    }

public function detailProperty($id)
{
    $property = $this->propertyModel->getProperty($id);
    $logout_url = site_url('auth/logout');

    if (!$property) {
        return redirect()->to('/admin/properties/index')->with('error', 'Property not found');
    }

    // Pastikan data agen tersedia
    if (!isset($property['agent'])) {
        // Jika data agen tidak ada di properti, Anda mungkin perlu mengambilnya secara terpisah
        $agentModel = new \App\Models\AgentModel(); // Sesuaikan dengan nama model agen Anda
        $property['agent'] = $agentModel->find($property['agent_id']); // Sesuaikan dengan cara Anda menyimpan ID agen di properti
    }

    $data = [
        'property' => $property,
        'logout_url' => $logout_url,
    ];

    return view('admin/properties/detail', $data);
}

public function createProperty()
{
$logout_url = site_url('auth/logout');
    return view('admin/properties/create', ['logout_url' => $logout_url]);
}

public function storeProperty()
{
    $data = $this->request->getPost();
    $files = $this->request->getFiles();
    if (!empty($files['photos'])) {
        $data['photos'] = $files['photos'];
    }

    log_message('debug', 'Data yang diterima di storeProperty: ' . print_r($data, true));

    $response = $this->propertyModel->createProperty($data);

    log_message('debug', 'Response dari createProperty: ' . print_r($response, true));

    if ($response) {
        session()->setFlashdata('success', 'Property berhasil ditambahkan.');
    } else {
        session()->setFlashdata('error', 'Terjadi kesalahan saat menambahkan property.');
    }

    // Return a RedirectResponse instead of a string URL
    return redirect()->to('admin/properties/index');
}


public function showProperty($id)
{
    $property = $this->propertyModel->getProperty($id);
    $imageUrl = $this->propertyModel->getPropertyImageUrl($id);
$logout_url = site_url('auth/logout');

    return view('properties/index', ['property' => $property, 'imageUrl' => $imageUrl, 'logout_url' => $logout_url]);
}

public function editProperty($id)
{
    $property = $this->propertyModel->getProperty($id);
$logout_url = site_url('auth/logout');
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
        if ($response['success']) {
            // Jika berhasil, set flash message dan redirect
            session()->setFlashdata('success', $response['message']);
        } else {
            // Jika gagal, set flash message error
            session()->setFlashdata('error', $response['message']);
        }
        // Redirect ke halaman index dalam kedua kasus
        return redirect()->to('/admin/properties/index');
    }
    
    // Jika bukan metode DELETE, redirect dengan pesan error
    session()->setFlashdata('error', 'Metode tidak diizinkan');
    return redirect()->to('/admin/properties/index');
}


public function agents()
{
    $agentModel = new AgentModel();
    $agents = $agentModel->getAllAgents();
$logout_url = site_url('auth/logout');

    return view('admin/agents/index', ['agents' => $agents, 'logout_url' => $logout_url]);
}

public function detailAgent($id)
{
    $agent = $this->agentModel->getAgent($id);
    $logout_url = site_url('auth/logout');

    if (!$agent) {
        return redirect()->to('/admin/agents/index')->with('error', 'Agen tidak ditemukan');
    }

    $data = [
        'agent' => $agent,
        'logout_url' => $logout_url,
    ];

    return view('admin/agents/detail', $data);
}


public function createAgent()
{
$logout_url = site_url('auth/logout');
    return view('admin/agents/create', ['logout_url' => $logout_url]);
}



public function storeAgent()
    {
        $data = $this->request->getPost();

        if ($this->request->getFile('agent_photo')->isValid()) {
            $data['agent_photo'] = $this->request->getFile('agent_photo')->getTempName();
        }

        // Periksa apakah email ada dalam data yang dikirim
        if (!isset($data['email'])) {
            return redirect()->back()->withInput()->with('error', 'Email harus diisi.');
        }

        $email = $data['email'];
        if ($this->agentModel->isEmailExists($email)) {
            return redirect()->back()->withInput()->with('error', 'Email sudah digunakan.');
        }

        try {
            $response = $this->agentModel->createAgent($data);

            if ($response) {
                return redirect()->to('/admin/agents/index')->with('success', 'Agent berhasil dibuat.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat membuat agent.');
            }
        } catch (ServerException $e) {
            $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
            $errorMessage = $errorResponse['error'] ?? 'Terjadi kesalahan server';
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    public function editAgent($id)
{
    $agent = $this->agentModel->getAgent($id);
    if ($agent === null) {
        return redirect()->to('/admin/agents/index')->with('error', 'Agent tidak ditemukan.');
    }
    $logout_url = site_url('auth/logout');
    return view('admin/agents/edit', [
        'agent' => $agent,
        'logout_url' => $logout_url
    ]);
}

public function showAgent($id)
{
    $agent = $this->agentModel->getAgent($id);
    if ($agent === null) {
        return redirect()->to('/admin/agents/index')->with('error', 'Agent tidak ditemukan.');
    }
    $logout_url = site_url('auth/logout');
    return view('admin/agents/show', ['agent' => $agent, 'logout_url' => $logout_url]);
}


public function updateAgent($id)
    {
        $data = $this->request->getPost();

        if ($this->request->getFile('agent_photo')->isValid()) {
            $data['agent_photo'] = $this->request->getFile('agent_photo')->getTempName();
        }

        // Periksa apakah email ada dalam data yang dikirim
        if (!isset($data['email'])) {
            return redirect()->back()->withInput()->with('error', 'Email harus diisi.');
        }

        $email = $data['email'];
        $currentAgent = $this->agentModel->getAgent($id);
        if ($email !== $currentAgent['email'] && $this->agentModel->isEmailExists($email)) {
            return redirect()->back()->withInput()->with('error', 'Email sudah digunakan.');
        }

        try {
            $response = $this->agentModel->updateAgent($id, $data);

            if ($response !== null) {
                return redirect()->to('/admin/agents/index')->with('success', 'Data agent berhasil diperbarui.');
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
    $method = $this->request->getMethod(true);

    if ($method === 'DELETE') {
        $response = $agentModel->deleteAgent($id);
        if (isset($response['message']) && $response['message'] === 'Agent deleted successfully') {
            session()->setFlashdata('success', 'Agent berhasil dihapus.');
            return redirect()->to('/admin/agents/index');
        } else {
            $errorMessage = isset($response['message']) ? $response['message'] : 'Terjadi kesalahan saat menghapus agent.';
            return redirect()->to('/admin/agents/')->with('error', $errorMessage);
        }
    } else {
        return $this->response->setStatusCode(405)->setJSON(['error' => 'Metode permintaan tidak valid']);
    }
}


//UNTUK SHOWING 

public function showings()
{
    $showings = $this->showingModel->getAllShowings();
$logout_url = site_url('auth/logout');
    return view('admin/showings/index', ['showings' => $showings, 'logout_url' => $logout_url]);
}

public function detailShowing($id)
{
    $showing = $this->showingModel->getShowing($id);
    $logout_url = site_url('auth/logout');

    if (!$showing) {
        return redirect()->to('/admin/showings/index')->with('error', 'Showing tidak ditemukan');
    }

    $data = [
        'showing' => $showing,
        'logout_url' => $logout_url,
    ];

    return view('admin/showings/detail', $data);
}

public function createShowing()
{
    $propertyModel = new PropertyModel();
    $properties = $propertyModel->getAllProperties();
$logout_url = site_url('auth/logout');
    return view('admin/showings/create', [
        'properties' => $properties,
        'logout_url' => $logout_url
    ]);
}

public function storeShowing()
{
    $data = $this->request->getPost();
    $files = $this->request->getFiles();

    if (!isset($data['property_id'])) {
        session()->setFlashdata('error', 'Property ID harus diisi.');
        return redirect()->back()->withInput();
    }

    if (!empty($files['photos'])) {
        $data['photos'] = $files['photos'];
    }

    // Mendapatkan agent_id berdasarkan property_id yang dipilih
    $propertyModel = new PropertyModel();
    $property = $propertyModel->getProperty($data['property_id']);
    
    if (!$property) {
        session()->setFlashdata('error', 'Property tidak ditemukan.');
        return redirect()->back()->withInput();
    }
    
    $data['agent_id'] = $property['agent_id'];

    $response = $this->showingModel->createShowing($data);

    if ($response) {
        session()->setFlashdata('success', 'Showing berhasil ditambahkan.');
    } else {
        session()->setFlashdata('error', 'Terjadi kesalahan saat menambahkan showing.');
    }

    return redirect()->to('/admin/showings/index');
}

public function showShowing($id)
{
    $showing = $this->showingModel->getShowing($id);
$logout_url = site_url('auth/logout');
    return view('admin/showings/show', ['showing' => $showing, 'logout_url' => $logout_url]);
}

public function editShowing($id)
{
    $showing = $this->showingModel->getShowing($id);
    $propertyModel = new PropertyModel();
    $properties = $propertyModel->getAllProperties();
$logout_url = site_url('auth/logout');
    return view('admin/showings/edit', [
        'showing' => $showing,
        'properties' => $properties,
        'logout_url' => $logout_url
    ]);
}

public function updateShowing($id)
    {
        $data = $this->request->getPost();
        $files = $this->request->getFiles();

        if (!empty($files['photos'])) {
            $data['photos'] = $files['photos'];
        }

        // Periksa apakah property_id ada dalam data yang dikirim
        if (!isset($data['property_id'])) {
            return redirect()->back()->withInput()->with('error', 'Property ID harus diisi.');
        }

        $propertyModel = new PropertyModel();
        $property = $propertyModel->getProperty($data['property_id']);
        $data['agent_id'] = $property['agent_id'];

        $response = $this->showingModel->updateShowing($id, $data);

        if ($response) {
            return redirect()->to('/admin/showings/index')->with('success', 'Showing berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui Showing');
        }
    }

public function deleteShowing($id)
{
    $response = $this->showingModel->deleteShowing($id);
    if (isset($response['message'])) {
        return redirect()->to(site_url('admin/showings/index'))->with('success', $response['message']);
    } else {
        return redirect()->to(site_url('admin/showings/index'))->with('error', $response['error']);
    }
}


//deal
    public function deals()
    {
        $deals = $this->dealModel->getAllDeals();
    $logout_url = site_url('auth/logout');
        return view('admin/deals/index', ['deals' => $deals, 'logout_url' => $logout_url]);
    }

    public function showDeal($id)
    {
        $deal = $this->dealModel->getDeal($id);
    $logout_url = site_url('auth/logout');
        return view('admin/deals/show', ['deal' => $deal, 'logout_url' => $logout_url]);
    }

    public function createDeal()
    {
        $propertyModel = new PropertyModel();
        $properties = $propertyModel->getAllProperties();
    $logout_url = site_url('auth/logout');
        return view('admin/deals/create', [
            'properties' => $properties,
            'logout_url' => $logout_url
        ]);
    }

    public function storeDeal()
    {
        $data = $this->request->getPost();
        $documentation = $this->request->getFile('documentation');
        if ($documentation && $documentation->isValid()) {
            $data['documentation'] = $documentation;
        }

        // Periksa apakah property_id ada dalam data yang dikirim
        if (!isset($data['property_id'])) {
            return redirect()->back()->withInput()->with('error', 'Property ID harus diisi.');
        }

        $propertyModel = new PropertyModel();
        $property = $propertyModel->getProperty($data['property_id']);
        $data['agent_id'] = $property['agent_id'];

        $success = $this->dealModel->createDeal($data);
        if ($success) {
            return redirect()->to('/admin/deals/index')->with('success', 'Deal berhasil dibuat');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal membuat deal');
        }
    }


    public function editDeal($id)
    {
        $deal = $this->dealModel->getDeal($id);
        $propertyModel = new PropertyModel();
        $properties = $propertyModel->getAllProperties();
    $logout_url = site_url('auth/logout');
        return view('admin/deals/edit', [
            'deal' => $deal,
            'properties' => $properties,
            'logout_url' => $logout_url
        ]);
    }



    public function updateDeal($id)
    {
        $data = $this->request->getPost();
        $documentation = $this->request->getFile('documentation');
        if ($documentation && $documentation->isValid()) {
            $data['documentation'] = $documentation;
        }

        // Periksa apakah property_id ada dalam data yang dikirim
        if (!isset($data['property_id'])) {
            return redirect()->back()->withInput()->with('error', 'Property ID harus diisi.');
        }

        $propertyModel = new PropertyModel();
        $property = $propertyModel->getProperty($data['property_id']);
        $data['agent_id'] = $property['agent_id'];

        $success = $this->dealModel->updateDeal($id, $data);
        if ($success) {
            return redirect()->to('/admin/deals/index')->with('success', 'Deal berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui deal');
        }
    }

    public function deleteDeal($id)
    {
        $result = $this->dealModel->deleteDeal($id);
        if (is_array($result) && isset($result['message']) && $result['message'] === 'Deal deleted successfully') {
            return redirect()->to('/admin/deals/index')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus deal');
        }
    }
}