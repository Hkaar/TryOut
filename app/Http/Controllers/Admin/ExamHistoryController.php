<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExamResultExport;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Group;
use App\Services\FilterService;
use App\Traits\Modelor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExamHistoryController extends Controller
{
    use Modelor;

    public function __construct(
        protected FilterService $filterService,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $results = ExamResult::with(['exam', 'user']);

        if ($request->has('search') && $request->input('search')) {
            $this->filterService->search($results, 'exam.name', $request->input('search'));
        }

        if ($request->has('group') && $request->input('group') !== 'all') {
            $results->byGroupId((int) $request->input('group'));
        }

        if ($request->has('exam') && $request->input('exam') !== 'all') {
            $results->byExamId((int) $request->input('exam'));
        }

        if ($request->has('order')) {
            $this->filterService->order($results, $request->input('order') === 'latest' ? false : true);
        }

        $results = $results->paginate(20);

        $exams = Exam::all(['id', 'name']);
        $groups = Group::all(['id', 'name']);

        return view('admin.exam-history.index', [
            'results' => $results,
            'groups' => $groups,
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
     */
    public function downloadResults(Request $request): BinaryFileResponse
    {
        $examFilter = $request->input('exam') && $request->input('exam') !== 'all'
            ? (int) $request->input('exam')
            : null;

        $groupFilter = $request->input('group') && $request->input('group') !== 'all'
            ? (int) $request->input('group')
            : null;

        return Excel::download(new ExamResultExport(
            $examFilter,
            $groupFilter,
            $request->input('user')
        ), 'results.xlsx');
    }
}
