<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;

class HomeController extends Controller
{
    /**
     * Show the admin home page
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $weekTotalWorks = ExamResult::whereDate('start_date', '>=', now()->startOfWeek())->whereDate('start_date', '<=', now()->endOfWeek())->count();
        $weekTotalFinishes = ExamResult::whereDate('start_date', '>=', now()->startOfWeek())->whereDate('start_date', '<=', now()->endOfWeek())->where('finished', '=', 1)->count();

        $latestWorks = ExamResult::with('exam', 'user')->limit(10)->latest()->get();
        $latestFinishes = ExamResult::with('exam', 'user')->where('finished', 1)->limit(10)->latest()->get();

        return view('admin.home', [
            'weekTotalWorks' => $weekTotalWorks,
            'weekTotalFinishes' => $weekTotalFinishes,
            'latestWorks' => $latestWorks,
            'latestFinishes' => $latestFinishes,
        ]);
    }

    /**
     * Show the help page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function help()
    {
        return view('admin.help');
    }
}
