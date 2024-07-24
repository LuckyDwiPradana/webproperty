<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AuthController extends ResourceController
{
    use ResponseTrait;

    public $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/api/',
            'timeout'  => 5.0,
        ]);
    }

    public function index()
    {
        return view('auth/login');
    }

    public function login()
{
    $rules = [
        'email' => 'required|valid_email',
        'password' => 'required',
    ];

    if (!$this->validate($rules)) {
        return $this->fail($this->validator->getErrors());
    }

    $data = [
        'email' => $this->request->getVar('email'),
        'password' => $this->request->getVar('password'),
    ];

    try {
        $response = $this->client->post('login', [
            'json' => $data
        ]);

        $result = json_decode($response->getBody(), true);

        log_message('debug', 'Login response: ' . json_encode($result));

        session()->set([
            'isLoggedIn' => true,
            'user' => $result['user'],
            'token' => $result['token'],
            'role' => $result['role']
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Login berhasil',
            'redirect' => $result['role'] === 'admin' ? base_url('admin/index') : base_url('agent/index')
        ]);
    } catch (RequestException $e) {
        $response = $e->getResponse();
        $errorBody = json_decode($response->getBody(), true);
        log_message('error', 'Login error: ' . $e->getMessage());
        return $this->response->setStatusCode($response->getStatusCode())
                              ->setJSON(['messages' => $errorBody['message'] ?? 'Login gagal']);
    }
}

public function logout()
{
    try {
        $this->client->post('logout', [
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get('token'),
            ]
        ]);

        session()->destroy();

        return redirect()->to(site_url('/'))->with('message', 'Berhasil logout');
    } catch (RequestException $e) {
        log_message('error', 'Logout error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Gagal logout');
    }
}
}