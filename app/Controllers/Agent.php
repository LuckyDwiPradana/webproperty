<?php

namespace App\Controllers;
use App\Models\AgentPropertyModel;
use App\Models\AgentShowingModel;
use App\Models\AgentDealModel;
use CodeIgniter\HTTP\RedirectResponse;

class Agent extends BaseController
{
    private $propertyModel;
    private $dealModel;

    public function __construct()
    {
        $this->propertyModel = new AgentPropertyModel();
        $this->showingModel = new AgentShowingModel();
        $this->dealModel = new AgentDealModel();
    }

    public function index()
    {
        $data = [
            'logout_url' => '/auth/logout'
        ];
        return view('agent/index', $data);
    }

   public function properties()
    {
        $properties = $this->propertyModel->getAllProperties();
        return view('agent/properties/index', ['properties' => $properties]);
    }

    public function createProperty()
    {
        return view('agent/properties/create');
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
            return redirect()->to('/agent/properties/index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function showProperty($id)
    {
        $property = $this->propertyModel->getProperty($id);
        if (!empty($property)) {
            $imageUrl = $this->propertyModel->getPropertyImageUrl($id);
            return view('agent/properties/show', ['property' => $property['property'], 'imageUrl' => $imageUrl]);
        } else {
            return redirect()->to('/agent/properties')->with('error', 'Properti tidak ditemukan');
        }
    }

public function editProperty($id)
{
    $property = $this->propertyModel->getProperty($id);
    if (isset($property['property'])) {
        return view('agent/properties/edit', ['property' => $property['property']]);
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
        if ($response === true) {
            // Properti berhasil dihapus
            // Ambil daftar properti terbaru setelah menghapus
            $properties = $this->propertyModel->getAllProperties();
            return view('agent/properties/index', ['properties' => $properties, 'success' => 'Property berhasil dihapus']);
        } else {
            // Terjadi kesalahan
            $errorMessage = isset($response['message']) ? $response['message'] : 'Terjadi kesalahan saat menghapus properti.';
            // Ambil daftar properti terbaru setelah gagal menghapus
            $properties = $this->propertyModel->getAllProperties();
            return view('agent/properties/index', ['properties' => $properties, 'error' => $errorMessage]);
        }
    } else {
        // Metode permintaan tidak valid
        return $this->response->setStatusCode(405)->setJSON(['error' => 'Metode permintaan tidak valid']);
    }
}

//showing
public function showings()
    {
        $showings = $this->showingModel->getAllShowings();
        return view('agent/showings/index', ['showings' => $showings]);
    }

    public function createShowing()
    {
        $properties = $this->propertyModel->getAllProperties();

        return view('agent/showings/create', [
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
        $authAgentId = session()->get('agent_id'); // Asumsikan agent_id disimpan dalam sesi dengan kunci 'agent_id'
       $data['agent_id'] = $authAgentId;

        $response = $this->showingModel->createShowing($data);

        if ($response) {
            return redirect()->to('/agent/showings/index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function showShowing($id)
    {
        $showing = $this->showingModel->getShowing($id);
        return view('agent/showings/show', ['showing' => $showing]);
    }

    public function editShowing($id)
    {
        $showing = $this->showingModel->getShowing($id);
        $properties = $this->propertyModel->getAllProperties();

        return view('agent/showings/edit', [
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
        
       $authAgentId = session()->get('agent_id'); // Asumsikan agent_id disimpan dalam sesi dengan kunci 'agent_id'
       $data['agent_id'] = $authAgentId;

        $response = $this->showingModel->updateShowing($id, $data);

        if ($response) {
            return redirect()->to('/agent/showings/index')->with('success', 'Showing berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('errors', ['Terjadi kesalahan saat memperbarui Showing']);
        }
    }

    public function deleteShowing($id)
    {
        $response = $this->showingModel->deleteShowing($id);
        return redirect()->to('/agent/showings/index');
    }

    //deal
    public function deals()
    {
        $deals = $this->dealModel->getAllDeals();
        return view('agent/deals/index', ['deals' => $deals]);
    }

    public function showDeal($id)
    {
        $deal = $this->dealModel->getDeal($id);
        return view('agent/deals/show', ['deal' => $deal]);
    }

}