<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
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
     */
    public function show(int $id)
    {
        $exam = Exam::findOrFail($id);

        return view('exams.show', [
            'exam' => $exam,
        ]);
    }
}
