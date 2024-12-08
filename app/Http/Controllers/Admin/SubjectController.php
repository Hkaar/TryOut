<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Services\FilterService;
use App\Traits\Modelor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
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
        $subjects = Subject::query();

        if ($request->has('search') && $request->input('search')) {
            $this->filterService->search($subjects, 'name', $request->input('search'));
        }

        if ($request->has('order')) {
            $this->filterService->order($subjects, $request->input('order') === 'latest' ? false : true);
        }

        $subjects = $subjects->paginate(15, ['id', 'name']);

        return view('admin.subjects.index', [
            'subjects' => $subjects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
        ]);

        $subject = new Subject;
        $subject->fill($validated)->save();

        return redirect()->route('admin.subjects.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id)
    {
        $subject = Subject::findOrFail($id);

        return view('admin.subjects.show', [
            'subject' => $subject,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id)
    {
        $subject = Subject::findOrFail($id);

        return view('admin.subjects.edit', [
            'subject' => $subject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $subject = Subject::findOrFail($id);

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255', Rule::unique('subjects', 'name')->ignore($subject->id)],
        ]);

        $this->updateModel($subject, $validated);
        $subject->save();

        return redirect()->route('admin.subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(int $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->packets()->delete();
        $subject->delete();

        return response(null);
    }
}
