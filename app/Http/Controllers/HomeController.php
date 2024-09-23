<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the landing / welcome page
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the home page
     */
    public function index()
    {
        return view('home');
    }
}
