<?php

namespace App\Http\Controllers;

use App\Models\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $exams = Exam::paginate(20);

        return view('exams.index', [
            'exams' => $exams,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id)
    {
        $exam = Exam::findOrFail($id);

        return view('exams.show', [
            'exam' => $exam,
        ]);
    }
}
