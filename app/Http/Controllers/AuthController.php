<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }

    public function login()
    {
        return view('pages.auth.login');
    }
}
