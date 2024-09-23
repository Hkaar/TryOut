<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the admin home page
     */
    public function index()
    {
        return view('admin.home');
    }
}
