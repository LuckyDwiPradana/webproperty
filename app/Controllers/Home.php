<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home/index');
    }

    public function agents()
    {
        return view('home/agents');
    }

    public function properties()
    {
        return view('home/properties');
    }

    public function info()
    {
        return view('home/info');
    }

    public function kpr()
    {
        return view('home/kpr');
    }
}