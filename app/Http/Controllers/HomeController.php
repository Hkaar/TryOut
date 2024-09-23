<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the home page
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the landing / welcome page
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function welcome()
    {
        return view('welcome');
    }
}
