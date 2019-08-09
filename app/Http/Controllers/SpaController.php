<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function dashboard()
    {
        return view('layouts.app');
    }

    public function auth()
    {
        return view('layouts.auth');
    }
}
