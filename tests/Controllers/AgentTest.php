<?php

// Mendefinisikan namespace untuk file test ini
namespace Tests\Controllers;

// Mengimpor kelas-kelas yang diperlukan untuk testing
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Controllers\Agent;
use App\Models\AgentPropertyModel;
use App\Models\AgentShowingModel;
use App\Models\AgentDealModel;

// Mendefinisikan kelas AgentTest yang merupakan turunan dari CIUnitTestCase
class AgentTest extends CIUnitTestCase
    {
        // Menggunakan trait untuk testing controller dan database
        use ControllerTestTrait;
        use DatabaseTestTrait;
        
        // Mendeklarasikan variabel session yang akan digunakan dalam test
        protected $session;

        // Metode yang akan dijalankan sebelum setiap test
        public function setUp(): void
        {
            // Memanggil setUp dari parent class
            parent::setUp();
            
            // Membuat mock object untuk AgentPropertyModel
            $this->mockAgentPropertyModel = $this->getMockBuilder(AgentPropertyModel::class)
                                            ->disableOriginalConstructor()
                                            ->getMock();
            
            // Membuat mock object untuk AgentShowingModel
            $this->mockAgentShowingModel = $this->getMockBuilder(AgentShowingModel::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
            
            // Membuat mock object untuk AgentDealModel
            $this->mockAgentDealModel = $this->getMockBuilder(AgentDealModel::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
            
            // Menginisialisasi session
            $this->session = \Config\Services::session();
        }

    // Test untuk metode index
    public function testIndex()
        {
            // Mengatur mock object untuk mengembalikan array kosong
            // Menyusun agar metode 'getAllProperties' dari mock object 'mockAgentPropertyModel' mengembalikan array kosong
            $this->mockAgentPropertyModel->method('getAllProperties')->willReturn([]);
            // Menyusun agar metode 'getAllShowings' dari mock object 'mockAgentShowingModel' mengembalikan array kosong
            $this->mockAgentShowingModel->method('getAllShowings')->willReturn([]);
            // Menyusun agar metode 'getAllDeals' dari mock object 'mockAgentDealModel' mengembalikan array kosong
            $this->mockAgentDealModel->method('getAllDeals')->willReturn([]);
            // Menjalankan metode 'index' pada controller 'Agent'
            $result = $this->withUri('http://example.com/agent') // Mengatur URI yang akan digunakan untuk pengujian
                ->controller(Agent::class) // Menentukan controller yang akan diuji
                ->execute('index'); // Mengeksekusi metode 'index' pada controller tersebut


            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk metode properties
        public function testProperties()
        {
            // Membuat data mock untuk properti
            $mockProperties = [
                ['id' => 1, 'name' => 'Property 1', 'price' => 100000],
                ['id' => 2, 'name' => 'Property 2', 'price' => 200000],
            ];

            // Mengatur mock object untuk mengembalikan data mock
            $this->mockAgentPropertyModel->method('getAllProperties')->willReturn($mockProperties);

            // Menjalankan metode properties pada controller Agent
            $result = $this->withUri('http://example.com/admin/properties') // Mengatur URI yang akan digunakan untuk pengujian
                ->controller(Agent::class) // Menentukan controller yang akan diuji
                ->execute('properties'); // Mengeksekusi metode 'properties' pada controller tersebu

            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk metode createProperty
    public function testCreateProperty()
        {
            // Mencatat level output buffer sebelum tes
            $initialLevel = ob_get_level();

            // Menjalankan metode createProperty pada controller Agent
            $result = $this->withUri('http://example.com/admin/properties/create')// Mengatur URI yang akan digunakan untuk pengujian
                ->controller(Agent::class)// Menentukan controller yang akan diuji
                ->execute('createProperty');// Mengeksekusi metode 'createProperties' pada controller tersebu

            // Mengembalikan level output buffer ke keadaan awal
            // Selama tingkat output buffering (ob_get_level) lebih besar dari tingkat awal ($initialLevel)
            while (ob_get_level() > $initialLevel) {
                // Menghentikan output buffering dan membersihkan buffer
                ob_end_clean();
            }

            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk metode storeProperty
    public function testStoreProperty()
    {
        // Mengatur mock object untuk mengembalikan true saat createProperty dipanggil
        $this->mockAgentPropertyModel->method('createProperty')->willReturn(true);

        // Membuat data mock untuk properti baru
        $data = [
            'name' => 'Test Property',
            'price' => 100000,
            'address' => '123 Test St',
            'description' => 'A test property',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'year_built' => 2020,
            'property_type' => 'House',
        ];

        // Menjalankan metode storeProperty pada controller Agent
        $result = $this->withUri('http://example.com/admin/properties')
            ->controller(Agent::class)
            ->execute('storeProperty', $data);

        // Memastikan hasil tidak kosong
        $this->assertNotEmpty($result);
    }

    // Test untuk metode showProperty
    public function testShowProperty()
    {
        // Membuat data mock untuk properti
        $mockProperty = [
            'id' => 1,
            'name' => 'Test Property',
            'price' => 100000,
            'address' => '123 Test St',
        ];

        // Mengatur mock object untuk mengembalikan data mock
        // Menyusun agar metode 'getProperty' dari mock object 'mockAgentPropertyModel' mengembalikan nilai 'mockProperty'
        $this->mockAgentPropertyModel->method('getProperty')->willReturn($mockProperty);
        // Menyusun agar metode 'getPropertyImageUrl' dari mock object 'mockAgentPropertyModel' mengembalikan URL gambar 'http://example.com/image.jpg'
        $this->mockAgentPropertyModel->method('getPropertyImageUrl')->willReturn('http://example.com/image.jpg');
        // Menjalankan metode 'showProperty' pada controller 'Agent'
        $result = $this->withUri('http://example.com/admin/properties/1') // Mengatur URI yang akan digunakan untuk pengujian
            ->controller(Agent::class)// Menentukan controller yang akan diuji
            ->execute('showProperty', 1);// Mengeksekusi metode 'showProperty' pada controller tersebut dengan argumen '1'


        // Memastikan hasil adalah string
        $this->assertIsString($result->getBody());
        // Memastikan hasil tidak kosong
        $this->assertNotEmpty($result->getBody());
    }

    // Test untuk metode detailProperty
    public function testDetailProperty()
        {
            // Buat data property palsu
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

            // Set return value untuk getProperty
            $this->mockAgentPropertyModel->method('getProperty')->willReturn($mockProperty);

            // Eksekusi metode detailProperty dan simpan hasilnya
            $result = $this->withUri('http://example.com/agent/properties/1/detail')
                ->controller(Agent::class)
                ->execute('detailProperty', 1);

            // Assertion untuk memastikan hasil sesuai ekspektasi
            //Memastikan bahwa nilai yang diuji adalah sebuah string.
            $this->assertIsString($result->getBody());
            //Memastikan bahwa nilai yang diuji tidak kosong.
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk metode editProperty
    public function testEditProperty()
        {
            // Membuat data mock untuk properti
            $mockProperty = [
                'id' => 1,
                'name' => 'Test Property',
                'price' => 100000,
                'address' => '123 Test St',
            ];

            // Mengatur mock object untuk mengembalikan data mock
            $this->mockAgentPropertyModel->method('getProperty')->willReturn($mockProperty);

            // Menjalankan metode editProperty pada controller Agent
            $result = $this->withUri('http://example.com/admin/properties/1/edit')
                ->controller(Agent::class)
                ->execute('editProperty', 1);

            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk metode updateProperty
    public function testUpdateProperty()
        {
            // Mengatur mock object untuk mengembalikan true saat updateProperty dipanggil
            $this->mockAgentPropertyModel->method('updateProperty')->willReturn(true);

            // Membuat data mock untuk properti yang diperbarui
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

            // Menjalankan metode updateProperty pada controller Agent
            $result = $this->withUri('http://example.com/admin/properties/1')
                ->controller(Agent::class)
                ->execute('updateProperty', 1);

            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result);
        }

    // Test untuk metode deleteProperty
    public function testDeleteProperty()
        {
            // Mengatur mock object untuk mengembalikan true saat deleteProperty dipanggil
            $this->mockAgentPropertyModel->method('deleteProperty')->willReturn(true);

            // Mengatur metode request menjadi DELETE
            $_SERVER['REQUEST_METHOD'] = 'DELETE';

            // Menjalankan metode deleteProperty pada controller Agent
            $result = $this->withUri('http://example.com/admin/properties/1')
                ->controller(Agent::class)
                ->execute('deleteProperty', 1);

            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result);
        }

    // Test untuk metode showings
    public function testShowings()
        {
            // Membuat data mock untuk showings
            $mockShowings = [
                ['id' => 1, 'property_id' => 1, 'Date' => '2023-07-15'],
                ['id' => 2, 'property_id' => 2, 'Date' => '2023-07-16'],
            ];

            // Mengatur mock object untuk mengembalikan data mock
            $this->mockAgentShowingModel->method('getAllShowings')->willReturn($mockShowings);

            // Menjalankan metode showings pada controller Agent
            $result = $this->withUri('http://example.com/agent/showings')
                ->controller(Agent::class)
                ->execute('showings');

            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk metode createShowing
    public function testCreateShowing()
        {
            // Membuat data mock untuk properties
            $mockProperties = [
                ['id' => 1, 'name' => 'Property 1'],
                ['id' => 2, 'name' => 'Property 2'],
            ];

            // Mengatur mock object untuk mengembalikan data mock
            $this->mockAgentPropertyModel->method('getAllProperties')->willReturn($mockProperties);

            // Menjalankan metode createShowing pada controller Agent
            $result = $this->withUri('http://example.com/agent/showings/create')
                ->controller(Agent::class)
                ->execute('createShowing');

            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk metode storeShowing
    public function testStoreShowing()
        {
            // Mengatur mock object untuk mengembalikan true saat createShowing dipanggil
            $this->mockAgentShowingModel->method('createShowing')->willReturn(true);

            // Membuat data mock untuk showing baru
            $data = [
                'property_id' => 1,
                'Date' => '2023-07-15',
                'Activity_name' => 'Test showing',
            ];

            // Mengatur session agent_id
            $_SESSION['agent_id'] = 1;

            // Menjalankan metode storeShowing pada controller Agent
            $result = $this->withUri('http://example.com/agent/showings')
                ->controller(Agent::class)
                ->execute('storeShowing', $data);

            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result);
        }

        // Test untuk metode showShowing
        public function testShowShowing()
        {
            // Membuat data mock untuk showing
            $mockShowing = [
                'id' => 1,
                'property_id' => 1,
                'Date' => '2023-07-15',
                'Activity_name' => 'Test showing',
            ];

            // Mengatur mock object untuk mengembalikan data mock
            // Menyusun agar metode 'getShowing' dari mock object 'mockAgentShowingModel' mengembalikan nilai 'mockShowing'
            $this->mockAgentShowingModel->method('getShowing')->willReturn($mockShowing);

            // Menjalankan metode 'showShowing' pada controller 'Agent'
            $result = $this->withUri('http://example.com/agent/showings/1') // Mengatur URI yang akan digunakan untuk pengujian
                ->controller(Agent::class)// Menentukan controller yang akan diuji
                ->execute('showShowing', 1);// Mengeksekusi metode 'showShowing' pada controller tersebut dengan argumen '1'


            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }

    
    // Test untuk metode editShowing
    public function testEditShowing()
        {
            // Membuat data mock untuk showing
            $mockShowing = [
                'id' => 1,
                'property_id' => 1,
                'Date' => '2023-07-15',
                'Activity_name' => 'Test showing',
            ];

            // Membuat data mock untuk properties
            $mockProperties = [
                ['id' => 1, 'name' => 'Property 1'],
                ['id' => 2, 'name' => 'Property 2'],
            ];

            // Mengatur mock object untuk mengembalikan data mock
            // Menyusun agar metode 'getShowing' dari mock object 'mockAgentShowingModel' mengembalikan nilai 'mockShowing'
            $this->mockAgentShowingModel->method('getShowing')->willReturn($mockShowing);

            // Menyusun agar metode 'getAllProperties' dari mock object 'mockAgentPropertyModel' mengembalikan nilai 'mockProperties'
            $this->mockAgentPropertyModel->method('getAllProperties')->willReturn($mockProperties);

            // Menjalankan metode 'editShowing' pada controller 'Agent'
            $result = $this->withUri('http://example.com/agent/showings/1/edit') // Mengatur URI yang akan digunakan untuk pengujian
                ->controller(Agent::class) // Menentukan controller yang akan diuji
                ->execute('editShowing', 1); // Mengeksekusi metode 'editShowing' pada controller tersebut dengan argumen '1'


            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk metode detailShowing
    public function testDetailShowing()
        {
            // Buat data showing palsu
            $mockShowing = [
                'id' => 1,
                'property_name' => 'Test Property',
                'agent_name' => 'Test Agent',
                'Date' => '2023-07-07',
                'Activity_name' => 'Open House',
                'Activity_description' => 'Showing rumah untuk calon pembeli',
            ];

            // Set return value untuk getShowing
            $this->mockAgentShowingModel->method('getShowing')->willReturn($mockShowing);

            // Eksekusi metode detailShowing dan simpan hasilnya
            $result = $this->withUri('http://example.com/agent/showings/1/detail')
                ->controller(Agent::class)
                ->execute('detailShowing', 1);

            // Assertion untuk memastikan hasil sesuai ekspektasi
            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk metode updateShowing
    public function testUpdateShowing()
        {
            // Mengatur mock object untuk mengembalikan true saat updateShowing dipanggil
            $this->mockAgentShowingModel->method('updateShowing')->willReturn(true);

            // Membuat data mock untuk showing yang diperbarui
            $data = [
                'property_id' => 1,
                'Date' => '2023-07-16',
                'Activity_name' => 'Updated test showing',
            ];

            // Mengatur session agent_id
            $_SESSION['agent_id'] = 1;

            // Menjalankan metode updateShowing pada controller Agent
            $result = $this->withUri('http://example.com/agent/showings/1')
                ->controller(Agent::class)
                ->execute('updateShowing', 1, $data);

            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result);
        }

    // Test untuk metode deleteShowing
    public function testDeleteShowing()
        {
            // Mengatur mock object untuk mengembalikan true saat deleteShowing dipanggil
        // Menyusun agar metode 'deleteShowing' dari mock object 'mockAgentShowingModel' mengembalikan nilai true
            $this->mockAgentShowingModel->method('deleteShowing')->willReturn(true);

            // Menjalankan metode 'deleteShowing' pada controller 'Agent'
            $result = $this->withUri('http://example.com/agent/showings/1') // Mengatur URI yang akan digunakan untuk pengujian
                ->controller(Agent::class) // Menentukan controller yang akan diuji
                ->execute('deleteShowing', 1); // Mengeksekusi metode 'deleteShowing' pada controller tersebut dengan argumen '1'


            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result);
        }

    // Test untuk metode deals
    public function testDeals()
        {
            // Membuat data mock untuk deals
            $mockDeals = [
                ['id' => 1, 'property_id' => 1, 'status' => 'Pending'],
                ['id' => 2, 'property_id' => 2, 'status' => 'Closed'],
            ];

            // Mengatur mock object untuk mengembalikan data mock
            $this->mockAgentDealModel->method('getAllDeals')->willReturn($mockDeals);

            // Menjalankan metode deals pada controller Agent
            $result = $this->withUri('http://example.com/agent/deals')
                ->controller(Agent::class)
                ->execute('deals');

            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }

    // Test untuk metode showDeal
    public function testShowDeal()
        {
            // Membuat data mock untuk deal
            $mockDeal = [
                'id' => 1,
                'property_id' => 1,
                'status' => 'Pending',
                'price' => 200000,
                'date' => '2023-07-15',
            ];

            // Mengatur mock object untuk mengembalikan data mock
            $this->mockAgentDealModel->method('getDeal')->willReturn($mockDeal);

            // Menjalankan metode showDeal pada controller Agent
            $result = $this->withUri('http://example.com/agent/deals/1')
                ->controller(Agent::class)
                ->execute('showDeal', 1);

            // Memastikan hasil adalah string
            $this->assertIsString($result->getBody());
            // Memastikan hasil tidak kosong
            $this->assertNotEmpty($result->getBody());
        }
    }