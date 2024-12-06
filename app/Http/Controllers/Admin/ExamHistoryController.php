<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExamResultExport;
use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use App\Traits\Modelor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExamHistoryController extends Controller
{
    use Modelor;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $results = ExamResult::with(['exam', 'user'])->paginate(20);

        return view('admin.exam-history.index', [
            'results' => $results,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id)
    {
        $result = ExamResult::findOrFail($id);

        return view('admin.exam-history.show', [
            'result' => $result,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id)
    {
        $result = ExamResult::findOrFail($id);

        return view('admin.exam-history.edit', [
            'result' => $result,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
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
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(int $id)
    {
        $result = ExamResult::findOrFail($id);

        $result->questionResults()->delete();
        $result->delete();

        return response(null);
    }

    /**
     * Download the exam results in excel
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function downloadResults(Request $request) {
        return Excel::download(new ExamResultExport(
            $request->input('exam_id'),
            $request->input('group_id'),
            $request->input('user_id')
        ), 'results.xlsx');
    }
}
