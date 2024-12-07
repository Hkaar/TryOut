<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Services\FilterService;
use App\Traits\Modelor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ExamController extends Controller
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
        $exams = Exam::with(['packet', 'group']);

        if ($request->has('search') && $request->input('search')) {
            $this->filterService->search($exams, 'name', $request->input('search'));
        }

        if ($request->has('order')) {
            $this->filterService->order($exams, $request->input('order') === 'latest' ? false : true);
        }

        $exams = $exams->paginate(20);

        return view('admin.exams.index', [
            'exams' => $exams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('admin.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
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
            'timezone' => 'required|timezone',
        ]);

        if ($request->has('token')) {
            $validated['token'] = Str::random(8);
        }

        $validated = $this->setExamSettings($request, ['public_results', 'auto_grade'], $validated);

        $validated['start_date'] = Carbon::parse((string) $validated['start_date'], (string) $validated['timezone'])->setTimezone('UTC');
        $validated['end_date'] = Carbon::parse((string) $validated['end_date'], (string) $validated['timezone'])->setTimezone('UTC');

        $exam = new Exam;
        $exam->fill($validated)->save();

        return redirect()->route('admin.exams.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
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
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $exam = Exam::findOrFail($id);

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255', Rule::unique('exams', 'name')->ignore($exam->id)],
            'duration' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'desc' => 'nullable|string',
            'group_id' => 'nullable|numeric|exists:groups,id',
            'packet_id' => 'nullable|numeric|exists:packets,id',
            'timezone' => 'required|timezone',
        ]);

        if ($request->has('token')) {
            $validated['token'] = Str::random(8);
        } else {
            $exam->token = null;
        }

        $validated = $this->setExamSettings($request, ['public_results', 'auto_grade'], $validated);

        if ($request->has('start_date')) {
            $validated['start_date'] = Carbon::parse((string) $validated['start_date'], (string) $validated['timezone'])->setTimezone('UTC');
        }

        if ($request->has('end_date')) {
            $validated['end_date'] = Carbon::parse((string) $validated['end_date'], (string) $validated['timezone'])->setTimezone('UTC');
        }

        $this->updateModel($exam, $validated);
        $exam->save();

        return redirect()->route('admin.exams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(int $id)
    {
        $exam = Exam::findOrFail($id);

        $exam->examResults()->delete();
        $exam->delete();

        return response(null);
    }

    /**
     * Update an exam settings
     *
     * @param  array<string>  $keys
     * @param  array<mixed>  $data
     * @return array<string, int>
     */
    private function setExamSettings(Request $request, array $keys, array $data)
    {
        foreach ($keys as $key) {
            $request->has($key)
                ? $data[$key] = 1
                : $data[$key] = 0;
        }

        return $data;
    }
}
