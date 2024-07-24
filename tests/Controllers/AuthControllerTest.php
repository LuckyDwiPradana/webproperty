<?php

namespace Tests\Controllers;

// Mengimpor kelas-kelas yang diperlukan untuk pengujian
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Controllers\AuthController;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

// Mendefinisikan kelas pengujian untuk AuthController
class AuthControllerTest extends CIUnitTestCase
{
    // Menggunakan trait untuk pengujian Controller dan Database
    use ControllerTestTrait;
    use DatabaseTestTrait;

    // Metode yang dijalankan sebelum setiap pengujian
    protected function setUp(): void
    {
        parent::setUp();
        // Membuat instance baru dari AuthController
        $this->controller = new AuthController();
        // Tempat untuk melakukan setup tambahan jika diperlukan
    }

    // Pengujian untuk metode index
    public function testIndex()
    {
        // Menjalankan metode index dari AuthController
        $result = $this->controller(AuthController::class)
                       ->execute('index');

        // Memeriksa apakah response OK dan mengandung kata 'Masuk'
        $this->assertTrue($result->isOK());
        $this->assertTrue($result->see('Masuk')); 
    }

    // Pengujian untuk kegagalan login
    public function testLoginFailure()
    {
        // Membuat mock untuk simulasi kegagalan request
        $mock = new MockHandler([
            new RequestException('Error Communicating with Server', new \GuzzleHttp\Psr7\Request('POST', 'login'), new Response(401, [], json_encode(['message' => 'Invalid credentials'])))
        ]);

        // Membuat handler stack dengan mock
        $handlerStack = HandlerStack::create($mock);
        // Mengganti client di controller dengan client yang menggunakan mock
        $this->controller->client = new Client(['handler' => $handlerStack]);

        // Menyiapkan data POST untuk login dengan email dan password kosong
        $_POST = [
            'email' => '',
            'password' => ''
        ];

        // Menjalankan metode login dari AuthController
        $result = $this->withUri('http://example.com/login')
            ->controller(AuthController::class)
            ->execute('login');

        // Memeriksa hasil pengujian
        $this->assertIsObject($result); //Memastikan bahwa nilai yang diuji adalah sebuah objek.biasanya berupa respon dari framewor
        $body = $result->getJSON(); //Digunakan untuk mengonversi respon menjadi string JSON
        $this->assertNotNull($body); //Digunakan untuk memastikan bahwa JSON body yang diambil dari respon tidak bernilai null.
        $data = json_decode($body, true); //Digunakan untuk mendekode string JSON menjadi array PHP.
        $this->assertIsArray($data); //Digunakan untuk memastikan bahwa hasil decoding JSON adalah array.
        $this->assertArrayHasKey('messages', $data); //igunakan untuk memastikan bahwa array $data memiliki kunci 'messages'
        $this->assertIsArray($data['messages']); //Digunakan untuk memastikan bahwa nilai dari $data['messages'] adalah array.
        $this->assertArrayHasKey('email', $data['messages']); //Digunakan untuk memastikan bahwa array $data['messages'] memiliki kunci 'email'.
        $this->assertArrayHasKey('password', $data['messages']); //Digunakan untuk memastikan bahwa array $data['messages'] memiliki kunci 'password'.
        $this->assertEquals('The email field is required.', $data['messages']['email']); //Digunakan untuk memastikan bahwa nilai dari $data['messages']['email'] adalah string 'The email field is required.'.
        $this->assertEquals('The password field is required.', $data['messages']['password']); //Digunakan untuk memastikan bahwa nilai dari $data['messages']['password'] adalah string 'The password field is required.'.

        // Memastikan session tidak memiliki flag isLoggedIn
        $this->assertFalse(session()->has('isLoggedIn'));
    }

    // Pengujian untuk kegagalan logout
    public function testLogoutFailure()
    {
        // Membuat mock untuk simulasi kegagalan request logout
        $mock = new MockHandler([
            new RequestException('Error Communicating with Server', new \GuzzleHttp\Psr7\Request('POST', 'logout'))
        ]);

        // Membuat handler stack dengan mock
        $handlerStack = HandlerStack::create($mock);
        // Mengganti client di controller dengan client yang menggunakan mock
        $this->controller->client = new Client(['handler' => $handlerStack]);

        // Menyiapkan session untuk pengujian
        session()->set('token', 'test_token');
        session()->set('isLoggedIn', true);

        // Menjalankan metode logout dari AuthController
        $result = $this->withUri('http://example.com/logout')
            ->controller(AuthController::class)
            ->execute('logout');

        // Memeriksa hasil pengujian
        $this->assertTrue($result->isRedirect());
        $this->assertEquals(site_url('/'), $result->getRedirectUrl());
        
        // Memastikan session masih memiliki flag isLoggedIn dan pesan error
        $this->assertTrue(session()->has('isLoggedIn')); // Memastikan bahwa session memiliki key 'isLoggedIn' yang bernilai true
        $this->assertTrue(session()->has('error'));// Memastikan bahwa session memiliki key 'error' yang bernilai true
        $this->assertEquals('Gagal logout', session('error')); // Memastikan bahwa nilai dari session dengan key 'error' sama dengan 'Gagal logout'
    }
}