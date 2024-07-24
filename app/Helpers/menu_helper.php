<?php

if (!function_exists('set_active')) {
    function set_active($uri)
    {
        $request = \Config\Services::request();
        return ($request->uri->getPath() === $uri) ? 'active' : '';
    }
}