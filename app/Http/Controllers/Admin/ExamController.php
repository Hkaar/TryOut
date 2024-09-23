<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Traits\Modelor;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    use Modelor;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::paginate(20);

        return view('admin.exams.index', [
            'exams' => $exams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:exams,name',
            'duration' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'desc' => 'nullable|string',
            'group_id' => 'required|numeric|exists:groups,id',
            'packet_id' => 'required|numeric|exists:packets,id',
        ]);

        $exam = new Exam;
        $exam->fill($validated)->save();

        return redirect()->route('admin.exams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $exam = Exam::findOrFail($id);

        return view('admin.exams.show', [
            'exam' => $exam,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $exam = Exam::findOrFail($id);

        return view('admin.exams.edit', [
            'exam' => $exam,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $exam = Exam::findOrFail($id);

        $validated = $request->validate([
            'name' => 'nullable|string|max:255|unique:exams,name',
            'duration' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'desc' => 'nullable|string',
            'group_id' => 'nullable|numeric|exists:groups,id',
            'packet_id' => 'nullable|numeric|exists:packets,id',
        ]);

        $this->updateModel($exam, $validated);
        $exam->save();

        return redirect()->route('admin.exams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $exam = Exam::findOrFail($id);

        $exam->examResults()->delete();
        $exam->delete();

        return response(null);
    }
}
