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
        $userId = auth()->id();

        $exams = Exam::with([
            'examResults' => function ($query) use ($userId) {
                $query->byUserId($userId);
            }
        ])->latest()->paginate(6, ['id', 'name', 'duration', 'start_date', 'end_date']);

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
