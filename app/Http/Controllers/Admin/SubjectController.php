<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Traits\Modelor;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    use Modelor;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::paginate(20);

        return view('admin.subjects.index', [
            'subjects' => $subjects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
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
     */
    public function update(Request $request, int $id)
    {
        $subject = Subject::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
        ]);

        $this->updateModel($subject, $validated);
        $subject->save();

        return redirect()->route('admin.subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->packets()->delete();
        $subject->delete();

        return response(null);
    }
}
