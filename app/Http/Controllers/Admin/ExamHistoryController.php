<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use App\Traits\Modelor;
use Illuminate\Http\Request;

class ExamHistoryController extends Controller
{
    use Modelor;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = ExamResult::paginate(20);

        return view('admin.exam-results.index', [
            'results' => $results,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $result = ExamResult::findOrFail($id);
        
        return view('admin.exam-results.show', [
            'result' => $result,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $result = ExamResult::findOrFail($id);
        
        return view('admin.exam-results.edit', [
            'result' => $result,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $result = ExamResult::findOrFail($id);

        $validated = $request->validate([
            'exam_id' => 'nullable|numeric|exists:exams,id',
            'user_id' => 'nullable|numeric|exists:users,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'grade' => 'nullable|numeric',
        ]);

        $this->updateModel($result, $validated);

        return redirect()->route('admin.exam-results.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $result = ExamResult::findOrFail($id);

        $result->questionResults()->delete();
        $result->delete();

        return response(null);
    }
}
