<?php

if (!function_exists('handle_api_response')) {
    function handle_api_response($callback) {
        try {
            return $callback();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);

            if ($statusCode === 401) {
                return [
                    'status' => 'error',
                    'message' => 'Sesi Anda telah berakhir atau Anda belum login. Silakan login kembali untuk melanjutkan.',
                    'redirect' => 'login'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => $body['message'] ?? 'Terjadi kesalahan. Silakan coba lagi nanti.'
                ];
            }
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return [
                'status' => 'error',
                'message' => 'Terjadi kesalahan pada server. Silakan coba lagi nanti atau hubungi administrator.'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Terjadi kesalahan yang tidak terduga. Silakan coba lagi nanti.'
            ];
        }
    }
}