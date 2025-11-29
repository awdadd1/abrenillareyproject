<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message'); // Landing page
    }

    public function maintenance()
    {
        return view('maintenance_message'); // Maintenance view for users
    }
}
