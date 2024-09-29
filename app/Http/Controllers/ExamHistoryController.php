<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;

class ExamHistoryController extends Controller
{
    /**
     * Show a list of the resource
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $user = auth()->user();
        $results = ExamResult::where('user_id', '=', $user->id)->paginate(20);

        return view('exam-history.index', [
            'results' => $results,
        ]);
    }

    /**
     * Show a detailed view of the resource
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id)
    {
        $user = auth()->user();

        $result = ExamResult::findOrFail($id);

        if ($result->user_id !== $user->id) {
            return redirect()->route('exam-history.index');
        }

        return view('exam-history.show', [
            'result' => $result,
        ]);
    }
}
