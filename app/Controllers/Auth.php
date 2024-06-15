<?php

namespace App\Controllers;

use CodeIgniter\HTTP\CURLRequest;

class Auth extends BaseController
{
    public function login()
    {
        $data = [];
        if ($this->request->getMethod() === 'get') {
            return view('auth/login', $data);
        }

        $role = $this->request->getPost('role');
        if ($role === 'admin') {
            return $this->loginAdmin();
        } elseif ($role === 'agent') {
            return $this->loginAgent();
        } else {
            $data['error'] = 'Invalid role selected.';
            return view('auth/login', $data);
        }
    }

    public function loginAdmin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $loginUrl = 'http://127.0.0.1:8000/api/login_admin';

        return $this->performLogin($loginUrl, $email, $password, 'admin');
    }

    public function loginAgent()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $loginUrl = 'http://127.0.0.1:8000/api/login_agen';

        return $this->performLogin($loginUrl, $email, $password, 'agent');
    }

    private function performLogin($loginUrl, $email, $password, $role)
{
    $curl = service('curlrequest');
    $data = [];
    try {
        $response = $curl->post($loginUrl, [
            'form_params' => [
                'email' => $email,
                'password' => $password,
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            $responseBody = $response->getBody();
            $authData = json_decode($responseBody);

            if (json_last_error() === JSON_ERROR_NONE) {
                if ($role === 'admin' && isset($authData->token)) {
                    session()->set('auth_token', $authData->token);
                    session()->set('role', $role);
                    session()->set('user_data', $authData->user);
                    return redirect()->to('/admin/index');
                } elseif ($role === 'agent' && isset($authData->access_token)) {
                    session()->set('auth_token', $authData->access_token);
                    session()->set('role', $role);
                    session()->set('agent_data', $authData->agent);
                    return redirect()->to('/agent/index');
                } else {
                    $data['error'] = 'Token not found in response.';
                }
            } else {
                $data['error'] = 'Invalid JSON response: ' . $responseBody;
            }
        } else {
            $data['error'] = json_decode($response->getBody())->message;
        }
    } catch (\Exception $e) {
        $data['error'] = 'An error occurred: ' . $e->getMessage();
    }

    return view('auth/login', $data);
}

    

    public function logout()
    {
        $logoutUrl = 'http://127.0.0.1:8000/api/logout';
        $curl = service('curlrequest');
        try {
            $response = $curl->post($logoutUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . session()->get('auth_token')
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                session()->remove('auth_token');
                session()->remove('role');
                return redirect()->to('/login');
            } else {
                $data['error'] = json_decode($response->getBody())->message;
                return redirect()->back()->with('error', $data['error']);
            }
        } catch (\Exception $e) {
            $data['error'] = 'An error occurred: ' . $e->getMessage();
            return redirect()->back()->with('error', $data['error']);
        }
    }
}