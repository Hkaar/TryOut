<?php

namespace App\Http\Controllers;

use App\Models\Exam;

class HomeController extends Controller
{
    /**
     * Show the home page
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $exams = Exam::latest()->paginate(12);

        return view('home', [
            'exams' => $exams,
        ]);
    }

    /**
     * Show the landing / welcome page
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function welcome()
    {
        return redirect()->route('home');
        // return view('welcome');
    }
}
