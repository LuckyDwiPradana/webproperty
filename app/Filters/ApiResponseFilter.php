<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ApiResponseFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Filter before tidak melakukan apa-apa
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $body = $response->getBody();
        if (is_string($body)) {
            $data = json_decode($body, true);
            if (json_last_error() === JSON_ERROR_NONE && isset($data['status']) && $data['status'] === 'error') {
                if (isset($data['redirect'])) {
                    return redirect()->to($data['redirect']);
                } else {
                    session()->setFlashdata('error', $data['message']);
                    return redirect()->to('error');
                }
            }
        }
        return $response;
    }
}