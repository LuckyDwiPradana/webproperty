<?php

namespace Tests\Controllers;

// Mengimpor kelas-kelas yang diperlukan untuk pengujian
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Controllers\Home;
use App\Models\PublicModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ReflectionClass;

// Mendefinisikan kelas pengujian untuk Controller Home
class HomeTest extends CIUnitTestCase
{
    // Menggunakan trait untuk pengujian Controller dan Database
    use ControllerTestTrait;
    use DatabaseTestTrait;
    protected $session;

    // Metode yang dijalankan sebelum setiap pengujian
    public function setUp(): void
    {
        parent::setUp();
        // Membuat mock object untuk PublicModel
        $this->mockPublicModel = $this->getMockBuilder(PublicModel::class)
                                        ->disableOriginalConstructor()
                                        ->getMock();
        // Inisialisasi sesi
        $this->session = \Config\Services::session();
    }

    // Pengujian untuk metode index
    public function testIndex()
    {
        // Menyiapkan data palsu untuk properti terbaru
        $mockPropertiTerbaru = [
            ['id' => 1, 'name' => 'Property 1', 'agent_id' => 1],
            ['id' => 2, 'name' => 'Property 2', 'agent_id' => 2],
            ['id' => 3, 'name' => 'Property 3', 'agent_id' => 3],
        ];

        // Menyiapkan data palsu untuk properti terpopuler
        $mockPropertiTerpopuler = [
            ['id' => 4, 'name' => 'Property 4', 'agent_id' => 1],
            ['id' => 5, 'name' => 'Property 5', 'agent_id' => 2],
            ['id' => 6, 'name' => 'Property 6', 'agent_id' => 3],
        ];

        // Menyiapkan data palsu untuk agen
        $mockAgent = ['id' => 1, 'name' => 'Agent 1'];

        // Mengatur perilaku mock object
        // Menyusun agar metode 'getPropertiTerbaru' dari mock object 'mockPublicModel' mengembalikan nilai 'mockPropertiTerbaru'
        $this->mockPublicModel->method('getPropertiTerbaru')->willReturn($mockPropertiTerbaru);
        // Menyusun agar metode 'getPropertiTerpopuler' dari mock object 'mockPublicModel' mengembalikan nilai 'mockPropertiTerpopuler'
        $this->mockPublicModel->method('getPropertiTerpopuler')->willReturn($mockPropertiTerpopuler);
        // Menyusun agar metode 'getAgentById' dari mock object 'mockPublicModel' mengembalikan nilai 'mockAgent'
        $this->mockPublicModel->method('getAgentById')->willReturn($mockAgent);

        // Menjalankan pengujian pada metode index
        $result = $this->withUri('http://example.com/')
            ->controller(Home::class)
            ->execute('index');

        // Memeriksa hasil pengujian
        $this->assertTrue($result->isOK()); // Memastikan bahwa hasil (response) memiliki status 'OK'
        $this->assertNotEmpty($result->getBody()); // Memastikan bahwa body dari hasil (response) tidak kosong
    }

    // Pengujian untuk metode agents
    public function testAgents()
    {
        // Menyiapkan data palsu untuk agen
        $mockAgents = [
            ['id' => 1, 'name' => 'Agent 1'],
            ['id' => 2, 'name' => 'Agent 2'],
        ];

        // Mengatur perilaku mock object
        $this->mockPublicModel->method('searchAgents')->willReturn($mockAgents);

        // Menjalankan pengujian pada metode agents
        $result = $this->withUri('http://example.com/agents')
            ->controller(Home::class) // Mengatur controller yang akan digunakan untuk pengujian, dalam hal ini 'Home'
            ->execute('agents'); // Mengeksekusi metode 'agents' pada controller yang ditentukan

        // Memeriksa hasil pengujian
        $this->assertTrue($result->isOK()); // Memastikan bahwa hasil (response) memiliki status 'OK'
        $this->assertStringContainsString('home/agents', $result->getBody()); // Memastikan bahwa body dari hasil (response) mengandung string 'home/agents'
    }

    // Pengujian untuk metode properties
    public function testProperties()
    {
        // Menyiapkan data palsu untuk properti
        $mockProperties = [
            ['id' => 1, 'name' => 'Property 1', 'agent_id' => 1],
            ['id' => 2, 'name' => 'Property 2', 'agent_id' => 2],
        ];

        // Menyiapkan data palsu untuk agen
        $mockAgent = ['id' => 1, 'name' => 'Agent 1'];

        // Mengatur perilaku mock object
        // Menyusun agar metode 'searchProperties' dari mock object 'mockPublicModel' mengembalikan nilai 'mockProperties'
        $this->mockPublicModel->method('searchProperties')->willReturn($mockProperties);
        // Menyusun agar metode 'getAgentById' dari mock object 'mockPublicModel' mengembalikan nilai 'mockAgent'
        $this->mockPublicModel->method('getAgentById')->willReturn($mockAgent);

        // Menjalankan pengujian pada metode properties
        $result = $this->withUri('http://example.com/properties')
            ->controller(Home::class) // Mengatur controller yang akan digunakan untuk pengujian, dalam hal ini 'Home'
            ->execute('properties'); // Mengeksekusi metode 'properties' pada controller yang ditentukan

        // Memeriksa hasil pengujian
        $this->assertTrue($result->isOK()); // Memastikan bahwa hasil (response) memiliki status 'OK'
        $this->assertStringContainsString('home/properties', $result->getBody());  // Memastikan bahwa body dari hasil (response) mengandung string 'home/properties'
    }

    // Pengujian untuk metode info
    public function testInfo()
    {
        // Menjalankan pengujian pada metode info
        $result = $this->withUri('http://example.com/info')
            ->controller(Home::class) // Mengatur controller yang akan digunakan untuk pengujian, dalam hal ini 'Home'
            ->execute('info');// Mengeksekusi metode 'info' pada controller yang ditentukan

        // Memeriksa hasil pengujian
        $this->assertTrue($result->isOK());// Memastikan bahwa hasil (response) memiliki status 'OK'
        $this->assertStringContainsString('home/info', $result->getBody());// Memastikan bahwa body dari hasil (response) mengandung string 'home/info'
    }

    // Pengujian untuk metode kpr
    public function testKpr()
    {
        // Menjalankan pengujian pada metode kpr
        $result = $this->withUri('http://example.com/kpr')
            ->controller(Home::class) // Mengatur controller yang akan digunakan untuk pengujian, dalam hal ini 'Home'
            ->execute('kpr');// Mengeksekusi metode 'kpr' pada controller yang ditentukan


        // Memeriksa hasil pengujian
        $this->assertTrue($result->isOK()); // Memastikan bahwa hasil (response) memiliki status 'OK'
        $this->assertStringContainsString('home/kpr', $result->getBody());// Memastikan bahwa body dari hasil (response) mengandung string 'home/kpr'
    }

    // Pengujian untuk metode agent_info
    public function testAgentInfo()
    {
        // Menyiapkan data palsu untuk agen
        $mockAgent = ['id' => 1, 'name' => 'Agent 1'];
        // Menyiapkan data palsu untuk properti
        $mockProperties = [
            ['id' => 1, 'name' => 'Property 1', 'created_at' => '2023-07-01'],
            ['id' => 2, 'name' => 'Property 2', 'created_at' => '2023-07-02'],
        ];

        // Mengatur perilaku mock object
        // Menyusun agar metode 'getAgentById' dari mock object 'mockPublicModel' mengembalikan nilai 'mockAgent'
        $this->mockPublicModel->method('getAgentById')->willReturn($mockAgent);
        // Menyusun agar metode 'searchPropertiesByAgent' dari mock object 'mockPublicModel' mengembalikan nilai 'mockProperties'
        $this->mockPublicModel->method('searchPropertiesByAgent')->willReturn($mockProperties);


        // Menjalankan pengujian pada metode agent_info
        $result = $this->withUri('http://example.com/agent/1')
            ->controller(Home::class) // Mengatur controller yang akan digunakan untuk pengujian, dalam hal ini 'Home'
            ->execute('agent_info', 1);// Mengeksekusi metode 'agent_info' pada controller yang ditentukan dengan argumen 1

        // Memeriksa hasil pengujian
        $this->assertTrue($result->isOK());// Memastikan bahwa hasil (response) memiliki status 'OK'
        $this->assertNotEmpty($result->getBody());// Memastikan bahwa body dari hasil (response) tidak kosong
    }

    public function testPropertiesInfo()
{
    // Menyiapkan data palsu untuk properti
    $mockProperties = [
        ['id' => 1, 'name' => 'Property 1', 'agent_id' => 1],
        ['id' => 2, 'name' => 'Property 2', 'agent_id' => 2],
    ];

    // Menyiapkan data palsu untuk agen
    $mockAgent = ['id' => 1, 'name' => 'Agent 1'];

    // Mengatur perilaku mock object
    // Menyusun agar metode 'getAllProperties' dari mock object 'mockPublicModel' mengembalikan nilai 'mockProperties'
    $this->mockPublicModel->method('getAllProperties')->willReturn($mockProperties);
    // Menyusun agar metode 'getAgentById' dari mock object 'mockPublicModel' mengembalikan nilai 'mockAgent'
    $this->mockPublicModel->method('getAgentById')->willReturn($mockAgent);


    // Membuat instance dari Home controller
    $home = new Home();

    // Menggunakan Reflection untuk mengakses properti protected
    // Membuat instance ReflectionClass dari objek $home
    $reflection = new ReflectionClass($home);
    // Mendapatkan properti 'publicModel' dari class $home
    $property = $reflection->getProperty('publicModel');
    // Mengatur properti 'publicModel' agar dapat diakses meskipun bersifat private atau protected
    $property->setAccessible(true);
    // Menetapkan nilai dari properti 'publicModel' pada objek $home menjadi $this->mockPublicModel
    $property->setValue($home, $this->mockPublicModel);


    // Menjalankan pengujian pada metode properties_info untuk properti yang ada
    $result = $this->withUri('http://example.com/property/1')
        ->controller(Home::class) // Mengatur controller yang akan digunakan untuk pengujian, dalam hal ini 'Home'
        ->execute('properties_info', 1);// Mengeksekusi metode 'agent_info' pada controller yang ditentukan dengan argumen 1

    // Memeriksa hasil pengujian
    $this->assertIsObject($result);// Memastikan bahwa hasil (response) memiliki status 'OK'
    $this->assertNotEmpty($result->getBody());// Memastikan bahwa body dari hasil (response) tidak kosong

    // Menguji kasus ketika properti tidak ditemukan
    // Mengharapkan bahwa pengecualian (exception) PageNotFoundException akan dilempar
    $this->expectException(PageNotFoundException::class);
    // Memanggil metode 'properties_info' pada objek $home dengan argumen 999
    $home->properties_info(999);
    }
}