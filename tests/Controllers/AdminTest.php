<?php
// Deklarasi namespace untuk file test ini
namespace Tests\Controllers;

// Import kelas-kelas yang diperlukan
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Controllers\Admin;
use App\Models\PropertyModel;
use App\Models\AgentModel;
use App\Models\ShowingModel;
use App\Models\DealModel;

// Definisi kelas AdminTest yang merupakan turunan dari CIUnitTestCase
class AdminTest extends CIUnitTestCase
{
    // Gunakan trait untuk pengujian controller dan database
    use ControllerTestTrait;
    use DatabaseTestTrait;
    
    // Deklarasi variabel protected untuk menyimpan objek session
    protected $session;

    // Metode setUp yang akan dijalankan sebelum setiap test
    public function setUp(): void
    {
        // Panggil setUp dari parent class
        parent::setUp();
        
        // Buat mock object untuk model-model yang digunakan
        $this->mockPropertyModel = $this->getMockBuilder(PropertyModel::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $this->mockAgentModel = $this->getMockBuilder(AgentModel::class)
                                     ->disableOriginalConstructor()
                                     ->getMock();
        $this->mockShowingModel = $this->getMockBuilder(ShowingModel::class)
                                       ->disableOriginalConstructor()
                                       ->getMock();
        $this->mockDealModel = $this->getMockBuilder(DealModel::class)
                                    ->disableOriginalConstructor()
                                    ->getMock();
        
        // Inisialisasi objek session
        $this->session = \Config\Services::session();
    }

    // Test untuk method index
    public function testIndex()
        {
            // Set return value untuk method-method yang dipanggil di dalam index
            // Menyusun agar metode 'getAllProperties' dari mock object 'mockPropertyModel' mengembalikan array kosong
            $this->mockPropertyModel->method('getAllProperties')->willReturn([]);
            // Menyusun agar metode 'getAllAgents' dari mock object 'mockAgentModel' mengembalikan array kosong
            $this->mockAgentModel->method('getAllAgents')->willReturn([]);
            // Menyusun agar metode 'getAllShowings' dari mock object 'mockShowingModel' mengembalikan array kosong
            $this->mockShowingModel->method('getAllShowings')->willReturn([]);
            // Menyusun agar metode 'getAllDeals' dari mock object 'mockDealModel' mengembalikan array kosong
            $this->mockDealModel->method('getAllDeals')->willReturn([]);
            // Menjalankan metode 'index' pada controller 'Admin' dan menyimpan hasilnya
            $result = $this->withUri('http://example.com/admin') // Mengatur URI yang akan digunakan untuk pengujian
                ->controller(Admin::class)// Menentukan controller yang akan diuji
                ->execute('index');// Mengeksekusi metode 'index' pada controller tersebut

            // Assertion untuk memastikan hasil sesuai ekspektasi
            $this->assertIsString($result->getBody()); // Memastikan bahwa body dari hasil (response) adalah string
            $this->assertNotEmpty($result->getBody()); // Memastikan bahwa body dari hasil (response) tidak kosong
        }

    // Test untuk method properties
    public function testProperties()
    {
        // Buat data properti palsu
        $mockProperties = [
            ['id' => 1, 'name' => 'Property 1', 'price' => 100000],
            ['id' => 2, 'name' => 'Property 2', 'price' => 200000],
        ];

        // Set return value untuk getAllProperties
        // Menyusun agar metode 'getAllProperties' dari mock object 'mockPropertyModel' mengembalikan nilai 'mockProperties'
        $this->mockPropertyModel->method('getAllProperties')->willReturn($mockProperties);
        // Menjalankan metode 'properties' pada controller 'Admin' dan menyimpan hasilnya
        $result = $this->withUri('http://example.com/admin/properties') // Mengatur URI yang akan digunakan untuk pengujian
            ->controller(Admin::class) // Menentukan controller yang akan diuji
            ->execute('properties');// Mengeksekusi metode 'properties' pada controller tersebut

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody()); // Memastikan bahwa body dari hasil (response) adalah string
        $this->assertNotEmpty($result->getBody()); // Memastikan bahwa body dari hasil (response) tidak kosong

    }

    
    // Test untuk method createProperty
    public function testCreateProperty()
    {
        // Menyimpan tingkat awal output buffering
        $initialLevel = ob_get_level();

        // Menjalankan metode 'createProperty' pada controller 'Admin' dan menyimpan hasilnya
        $result = $this->withUri('http://example.com/admin/properties/create') // Mengatur URI yang akan digunakan untuk pengujian
            ->controller(Admin::class)// Menentukan controller yang akan diuji
            ->execute('createProperty'); // Mengeksekusi metode 'createProperty' pada controller tersebut

        // Kembalikan level output buffer ke keadaan awal
        while (ob_get_level() > $initialLevel) {
            ob_end_clean();  // Menghentikan output buffering saat ini dan membersihkan buffer
        }

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody()); // Memastikan bahwa body dari hasil (response) adalah string
        $this->assertNotEmpty($result->getBody()); // Memastikan bahwa body dari hasil (response) tidak kosong

    }

    // Test untuk method storeProperty
    public function testStoreProperty()
    {
        // Menyusun agar metode 'createProperty' dari mock object 'mockPropertyModel' mengembalikan nilai true
        $this->mockPropertyModel->method('createProperty')->willReturn(true);

        // Buat data properti palsu
        $data = [
            'name' => 'Test Property',
            'price' => 100000,
            'address' => '123 Test St',
            'description' => 'A test property',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'square_feet' => 1500,
            'year_built' => 2020,
            'property_type' => 'House',
        ];

        // Eksekusi method storeProperty dan simpan hasilnya
       // Menjalankan metode 'storeProperty' pada controller 'Admin' dengan data yang diberikan dan menyimpan hasilnya
        $result = $this->withUri('http://example.com/admin/properties') // Mengatur URI yang akan digunakan untuk pengujian
            ->controller(Admin::class) // Menentukan controller yang akan diuji
            ->execute('storeProperty', $data); // Mengeksekusi metode 'storeProperty' pada controller tersebut dengan argumen $data

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk method showProperty
    public function testShowProperty()
    {
        // Buat data properti palsu
        $mockProperty = [
            'id' => 1,
            'name' => 'Test Property',
            'price' => 100000,
            'address' => '123 Test St',
        ];

        // Menyusun agar metode 'getProperty' dari mock object 'mockPropertyModel' mengembalikan nilai 'mockProperty'
        $this->mockPropertyModel->method('getProperty')->willReturn($mockProperty);
        // Menyusun agar metode 'getPropertyImageUrl' dari mock object 'mockPropertyModel' mengembalikan URL gambar 'http://example.com/image.jpg'
        $this->mockPropertyModel->method('getPropertyImageUrl')->willReturn('http://example.com/image.jpg');

        // Menjalankan metode 'showProperty' pada controller 'Admin' dan menyimpan hasilnya
        $result = $this->withUri('http://example.com/admin/properties/1') // Mengatur URI yang akan digunakan untuk pengujian
            ->controller(Admin::class) // Menentukan controller yang akan diuji
            ->execute('showProperty', 1);// Mengeksekusi metode 'showProperty' pada controller tersebut dengan argumen '1'

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody()); // Memastikan bahwa body dari hasil (response) adalah string
        $this->assertNotEmpty($result->getBody()); // Memastikan bahwa body dari hasil (response) tidak kosong

    }

    // Test untuk method detailProperty
    public function testDetailProperty()
        {
            // Buat data properti palsu
            $mockProperty = [
                'id' => 1,
                'name' => 'Test Property',
                'price' => 100000,
                'address' => '123 Test St',
                'agent_id' => 1,
                'agent' => [
                    'id' => 1,
                    'name' => 'Test Agent',
                    'email' => 'agent@example.com'
                ]
            ];

            // Menyusun agar metode 'getProperty' dari mock object 'mockPropertyModel' mengembalikan nilai 'mockProperty'
            $this->mockPropertyModel->method('getProperty')->willReturn($mockProperty);

            // Menjalankan metode 'detailProperty' pada controller 'Admin' dan menyimpan hasilnya
            $result = $this->withUri('http://example.com/admin/properties/1/detail') // Mengatur URI yang akan digunakan untuk pengujian
                ->controller(Admin::class)  // Menentukan controller yang akan diuji
                ->execute('detailProperty', 1);// Mengeksekusi metode 'detailProperty' pada controller tersebut dengan argumen '1'

            // Assertion untuk memastikan hasil sesuai ekspektasi
            $this->assertIsString($result->getBody()); // Memastikan bahwa body dari hasil (response) adalah string
            $this->assertNotEmpty($result->getBody()); // Memastikan bahwa body dari hasil (response) tidak kosong

        }

    // Test untuk method editProperty
    public function testEditProperty()
    {
        // Buat data properti palsu
        $mockProperty = [
            'id' => 1,
            'name' => 'Test Property',
            'price' => 100000,
            'address' => '123 Test St',
        ];

        // Menyusun agar metode 'getProperty' dari mock object 'mockPropertyModel' mengembalikan nilai 'mockProperty'
        $this->mockPropertyModel->method('getProperty')->willReturn($mockProperty);

        // Menjalankan metode 'editProperty' pada controller 'Admin' dan menyimpan hasilnya
        $result = $this->withUri('http://example.com/admin/properties/1/edit') // Mengatur URI yang akan digunakan untuk pengujian
            ->controller(Admin::class)// Menentukan controller yang akan diuji
            ->execute('editProperty', 1);  // Mengeksekusi metode 'editProperty' pada controller tersebut dengan argumen '1'

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody()); // Memastikan bahwa body dari hasil (response) adalah string
        $this->assertNotEmpty($result->getBody()); // Memastikan bahwa body dari hasil (response) tidak kosong

    }

    // Test untuk method updateProperty
    public function testUpdateProperty()
    {
        // Set return value untuk updateProperty
        $this->mockPropertyModel->method('updateProperty')->willReturn(true);

        // Buat data properti palsu untuk update
        $data = [
            'name' => 'Updated Property',
            'price' => 150000,
            'address' => '456 Updated St',
            'description' => 'An updated property',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'square_feet' => 2000,
            'year_built' => 2021,
            'property_type' => 'Apartment',
        ];

        // Eksekusi method updateProperty dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/properties/1')
            ->controller(Admin::class)
            ->execute('updateProperty', 1);

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk method deleteProperty
    public function testDeleteProperty()
    {
        // Menyusun agar metode 'deleteProperty' dari mock object 'mockPropertyModel' mengembalikan nilai true
        $this->mockPropertyModel->method('deleteProperty')->willReturn(true);

        // Mensimulasikan metode HTTP DELETE
        $_SERVER['REQUEST_METHOD'] = 'DELETE';

        // Menjalankan metode 'deleteProperty' pada controller 'Admin' dan menyimpan hasilnya
        $result = $this->withUri('http://example.com/admin/properties/1') // Mengatur URI yang akan digunakan untuk pengujian
            ->controller(Admin::class)// Menentukan controller yang akan diuji
            ->execute('deleteProperty', 1);// Mengeksekusi metode 'deleteProperty' pada controller tersebut dengan argumen '1'


        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }


    // Test untuk method agents
    public function testAgents()
    {
        // Buat data agen palsu
        $mockAgents = [
            ['id' => 1, 'name' => 'Agent 1', 'email' => 'agent1@example.com'],
            ['id' => 2, 'name' => 'Agent 2', 'email' => 'agent2@example.com'],
        ];

        // Set return value untuk getAllAgents
        $this->mockAgentModel->method('getAllAgents')->willReturn($mockAgents);

        // Eksekusi method agents dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/agents')
            ->controller(Admin::class)
            ->execute('agents');

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method createAgent
    public function testCreateAgent()
    {
        // Catat level output buffer sebelum tes
        $initialLevel = ob_get_level();

        // Eksekusi method createAgent dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/agents/create')
            ->controller(Admin::class)
            ->execute('createAgent');

        // Kembalikan level output buffer ke keadaan awal
        while (ob_get_level() > $initialLevel) {
            ob_end_clean();
        }

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method storeAgent
    public function testStoreAgent()
    {
        // Set return value untuk createAgent dan isEmailExists
        $this->mockAgentModel->method('createAgent')->willReturn(true);
        $this->mockAgentModel->method('isEmailExists')->willReturn(false);

        // Buat data agen palsu
        $data = [
            'name' => 'Test Agent',
            'email' => 'testagent@example.com',
            'phone' => '1234567890',
            'password' => 'password123',
        ];

        // Simulasi upload file
        $_FILES = [
            'agent_photo' => [
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => 1024,
                'tmp_name' => '/tmp/test.jpg',
                'error' => 0,
            ]
        ];

        // Eksekusi method storeAgent dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/agents')
            ->controller(Admin::class)
            ->execute('storeAgent', $data);

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk method detailAgent
    public function testDetailAgent()
        {
            // Buat data agen palsu
            $mockAgent = [
                'id' => 1,
                'name' => 'Test Agent',
                'email' => 'testagent@example.com',
                'phone' => '1234567890',
                'photo' => 'agent.jpg',
            ];

            // Set return value untuk getAgent
            $this->mockAgentModel->method('getAgent')->willReturn($mockAgent);

            // Eksekusi method detailAgent dan simpan hasilnya
            $result = $this->withUri('http://example.com/admin/agents/1/detail')
                ->controller(Admin::class)
                ->execute('detailAgent', 1);

            // Assertion untuk memastikan hasil sesuai ekspektasi
            $this->assertIsString($result->getBody());
            $this->assertNotEmpty($result->getBody());
        }


    // Test untuk method editAgent
    public function testEditAgent()
    {
        // Buat data agen palsu
        $mockAgent = [
            'id' => 1,
            'name' => 'Test Agent',
            'email' => 'testagent@example.com',
            'phone' => '1234567890',
        ];

        // Set return value untuk getAgent
        $this->mockAgentModel->method('getAgent')->willReturn($mockAgent);

        // Eksekusi method editAgent dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/agents/1/edit')
            ->controller(Admin::class)
            ->execute('editAgent', 1);

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method showAgent
    public function testShowAgent()
    {
        // Buat data agen palsu
        $mockAgent = [
            'id' => 1,
            'name' => 'Test Agent',
            'email' => 'testagent@example.com',
            'phone' => '1234567890',
            'photo' => 'agent.jpg',
        ];

        // Set return value untuk getAgent
        $this->mockAgentModel->method('getAgent')->willReturn($mockAgent);

        // Eksekusi method showAgent dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/agents/1')
            ->controller(Admin::class)
            ->execute('showAgent', 1);

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method updateAgent
    public function testUpdateAgent()
    {
        // Set return value untuk updateAgent, isEmailExists, dan getAgent
        $this->mockAgentModel->method('updateAgent')->willReturn(true);
        $this->mockAgentModel->method('isEmailExists')->willReturn(false);
        $this->mockAgentModel->method('getAgent')->willReturn(['email' => 'testagent@example.com']);

        // Buat data agen palsu untuk update
        $data = [
            'name' => 'Updated Agent',
            'email' => 'updatedagent@example.com',
            'phone' => '9876543210',
        ];

        // Simulasi upload file
        $_FILES = [
            'agent_photo' => [
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => 1024,
                'tmp_name' => '/tmp/test.jpg',
                'error' => 0,
            ]
        ];

        // Eksekusi method updateAgent dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/agents/1')
            ->controller(Admin::class)
            ->execute('updateAgent', 1);

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk method deleteAgent
    public function testDeleteAgent()
    {
        // Set return value untuk deleteAgent
        $this->mockAgentModel->method('deleteAgent')->willReturn(['message' => 'Agent deleted successfully']);

        // Set metode request ke DELETE
        $_SERVER['REQUEST_METHOD'] = 'DELETE';

        // Eksekusi method deleteAgent dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/agents/1')
            ->controller(Admin::class)
            ->execute('deleteAgent', 1);

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk method showings
    public function testShowings()
    {
        // Buat data showing palsu
        $mockShowings = [
            ['id' => 1, 'property_name' => 'Property 1', 'agent_name' => 'Agent 1'],
            ['id' => 2, 'property_name' => 'Property 2', 'agent_name' => 'Agent 2'],
        ];

        // Set return value untuk getAllShowings
        $this->mockShowingModel->method('getAllShowings')->willReturn($mockShowings);

        // Eksekusi method showings dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/showings')
            ->controller(Admin::class)
            ->execute('showings');

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method createShowing
    public function testCreateShowing()
    {
        // Buat data properti palsu
        $mockProperties = [
            ['id' => 1, 'name' => 'Property 1'],
            ['id' => 2, 'name' => 'Property 2'],
        ];

        // Set return value untuk getAllProperties
        $this->mockPropertyModel->method('getAllProperties')->willReturn($mockProperties);

        // Eksekusi method createShowing dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/showings/create')
            ->controller(Admin::class)
            ->execute('createShowing');

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method storeShowing
    public function testStoreShowing()
    {
        // Set return value untuk createShowing dan getProperty
        $this->mockShowingModel->method('createShowing')->willReturn(true);
        $this->mockPropertyModel->method('getProperty')->willReturn(['agent_id' => 1]);

        // Buat data showing palsu
        $data = [
            'property_id' => '1',
            'date' => '2023-07-07',
            'activity_name' => 'Open House',
            'activity_description' => 'Showing rumah untuk calon pembeli',
        ];

        // Simulasi upload file foto
        $_FILES['photos'] = [
            'name' => ['photo1.jpg'],
            'type' => ['image/jpeg'],
            'tmp_name' => ['/tmp/photo1.jpg'],
            'error' => [0],
            'size' => [1024]
        ];

        // Eksekusi method storeShowing dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/showings')
            ->controller(Admin::class)
            ->withRequest($this->request->setMethod('post')->setGlobal('post', $data))
            ->execute('storeShowing');

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk method showShowing
    public function testShowShowing()
    {
        // Buat data showing palsu
        $mockShowing = [
            'id' => 1,
            'property_name' => 'Test Property',
            'agent_name' => 'Test Agent',
            'date' => '2023-07-07',
        ];

        // Set return value untuk getShowing
        $this->mockShowingModel->method('getShowing')->willReturn($mockShowing);

        // Eksekusi method showShowing dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/showings/1')
            ->controller(Admin::class)
            ->execute('showShowing', 1);

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method detailShowing
    public function testDetailShowing()
        {
            // Buat data showing palsu
            $mockShowing = [
                'id' => 1,
                'property_name' => 'Test Property',
                'agent_name' => 'Test Agent',
                'date' => '2023-07-07',
                'activity_name' => 'Open House',
                'activity_description' => 'Showing rumah untuk calon pembeli',
            ];

            // Set return value untuk getShowing
            $this->mockShowingModel->method('getShowing')->willReturn($mockShowing);

            // Eksekusi method detailShowing dan simpan hasilnya
            $result = $this->withUri('http://example.com/admin/showings/1/detail')
                ->controller(Admin::class)
                ->execute('detailShowing', 1);

            // Assertion untuk memastikan hasil sesuai ekspektasi
            $this->assertIsString($result->getBody());
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk method editShowing
    public function testEditShowing()
    {
        // Buat data showing palsu
        $mockShowing = [
            'id' => 1,
            'property_id' => 1,
            'date' => '2023-07-07',
        ];

        // Buat data properti palsu
        $mockProperties = [
            ['id' => 1, 'name' => 'Property 1'],
            ['id' => 2, 'name' => 'Property 2'],
        ];

        // Set return value untuk getShowing dan getAllProperties
        $this->mockShowingModel->method('getShowing')->willReturn($mockShowing);
        $this->mockPropertyModel->method('getAllProperties')->willReturn($mockProperties);

        // Eksekusi method editShowing dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/showings/1/edit')
            ->controller(Admin::class)
            ->execute('editShowing', 1);

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method updateShowing
    public function testUpdateShowing()
    {
        // Set return value untuk updateShowing dan getProperty
        $this->mockShowingModel->method('updateShowing')->willReturn(true);
        $this->mockPropertyModel->method('getProperty')->willReturn(['agent_id' => 1]);

        // Buat data showing palsu untuk update
        $data = [
            'property_id' => 1,
            'date' => '2023-07-08',
        ];

        // Simulasi upload file foto
        $_FILES['photos'] = [
            'name' => ['photo1.jpg'],
            'type' => ['image/jpeg'],
            'tmp_name' => ['/tmp/photo1.jpg'],
            'error' => [0],
            'size' => [1024]
        ];

        // Eksekusi method updateShowing dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/showings/1')
            ->controller(Admin::class)
            ->execute('updateShowing', 1);

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk method deleteShowing
    public function testDeleteShowing()
    {
        // Set return value untuk deleteShowing
        $this->mockShowingModel->method('deleteShowing')->willReturn(['message' => 'Showing berhasil dihapus']);

        // Eksekusi method deleteShowing dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/showings/1')
            ->controller(Admin::class)
            ->execute('deleteShowing', 1);

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk method deals
    public function testDeals()
    {
        // Buat data deal palsu
        $mockDeals = [
            ['id' => 1, 'property_name' => 'Property 1', 'agent_name' => 'Agent 1'],
            ['id' => 2, 'property_name' => 'Property 2', 'agent_name' => 'Agent 2'],
        ];

        // Set return value untuk getAllDeals
        $this->mockDealModel->method('getAllDeals')->willReturn($mockDeals);

        // Eksekusi method deals dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/deals')
            ->controller(Admin::class)
            ->execute('deals');

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method showDeal
    public function testShowDeal()
    {
        // Buat data deal palsu
        $mockDeal = [
            'id' => 1,
            'property_name' => 'Test Property',
            'agent_name' => 'Test Agent',
            'price' => 100000,
        ];

        // Set return value untuk getDeal
        $this->mockDealModel->method('getDeal')->willReturn($mockDeal);

        // Eksekusi method showDeal dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/deals/1')
            ->controller(Admin::class)
            ->execute('showDeal', 1);

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method createDeal
    public function testCreateDeal()
    {
        // Buat data properti palsu
        $mockProperties = [
            ['id' => 1, 'name' => 'Property 1'],
            ['id' => 2, 'name' => 'Property 2'],
        ];

        // Set return value untuk getAllProperties
        $this->mockPropertyModel->method('getAllProperties')->willReturn($mockProperties);

        // Eksekusi method createDeal dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/deals/create')
            ->controller(Admin::class)
            ->execute('createDeal');

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method storeDeal
    public function testStoreDeal()
    {
        // Set return value untuk createDeal dan getProperty
        $this->mockDealModel->method('createDeal')->willReturn(true);
        $this->mockPropertyModel->method('getProperty')->willReturn(['agent_id' => 1]);

        // Buat data deal palsu
        $data = [
            'property_id' => '1',
            'price' => '100000',
            'status' => 'pending',
        ];

        // Simulasi upload file dokumentasi
        $_FILES['documentation'] = [
            'name' => 'doc.pdf',
            'type' => 'application/pdf',
            'tmp_name' => '/tmp/doc.pdf',
            'error' => 0,
            'size' => 1024
        ];

        // Eksekusi method storeDeal dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/deals')
            ->controller(Admin::class)
            ->withRequest($this->request->setMethod('post')->setGlobal('post', $data))
            ->execute('storeDeal');

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk method editDeal
    public function testEditDeal()
    {
        // Buat data deal palsu
        $mockDeal = [
            'id' => 1,
            'property_id' => 1,
            'price' => 100000,
            'status' => 'pending',
        ];

        // Buat data properti palsu
        $mockProperties = [
            ['id' => 1, 'name' => 'Property 1'],
            ['id' => 2, 'name' => 'Property 2'],
        ];

        // Set return value untuk getDeal dan getAllProperties
        $this->mockDealModel->method('getDeal')->willReturn($mockDeal);
        $this->mockPropertyModel->method('getAllProperties')->willReturn($mockProperties);

        // Eksekusi method editDeal dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/deals/1/edit')
            ->controller(Admin::class)
            ->execute('editDeal', 1);

        // Assertion untuk memastikan hasil sesuai ekspektasi
        $this->assertIsString($result->getBody());
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk method updateDeal
    public function testUpdateDeal()
    {
        // Set return value untuk updateDeal dan getProperty
        $this->mockDealModel->method('updateDeal')->willReturn(true);
        $this->mockPropertyModel->method('getProperty')->willReturn(['agent_id' => 1]);

        // Buat data deal palsu untuk update
        $data = [
            'property_id' => '1',
            'price' => '150000',
            'status' => 'completed',
        ];

        // Simulasi upload file dokumentasi
        $_FILES['documentation'] = [
            'name' => 'updated_doc.pdf',
            'type' => 'application/pdf',
            'tmp_name' => '/tmp/updated_doc.pdf',
            'error' => 0,
            'size' => 2048
        ];

        // Eksekusi method updateDeal dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/deals/1')
            ->controller(Admin::class)
            ->withRequest($this->request->setMethod('post')->setGlobal('post', $data))
            ->execute('updateDeal', 1);

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk method deleteDeal
    public function testDeleteDeal()
    {
        // Set return value untuk deleteDeal
        $this->mockDealModel->method('deleteDeal')->willReturn(['message' => 'Deal deleted successfully']);

        // Eksekusi method deleteDeal dan simpan hasilnya
        $result = $this->withUri('http://example.com/admin/deals/1')
            ->controller(Admin::class)
            ->execute('deleteDeal', 1);

        // Assertion untuk memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

} 