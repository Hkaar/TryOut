<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Traits\Modelor;
use App\Traits\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    use Modelor, Uploader;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $students = User::StrictByRole('student')->paginate(20);

        return view('admin.students.index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'phone' => 'required|string|max:64',
            'address' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $student = new User;
        $student->fill($validated);

        $role = Role::StrictByName('student')->first()->id;
        $student->role_id = $role;

        if ($request->has('img')) {
            $filePath = $this->uploadImage($request->file('img'));
            $student->img = $filePath;
        }

        $student->save();

        return redirect()->route('admin.students.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id)
    {
        $student = User::findOrFail($id);

        return view('admin.students.show', [
            'student' => $student,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id)
    {
        $student = User::findOrFail($id);

        return view('admin.students.edit', [
            'student' => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $student = User::findOrFail($id);

        $validated = $request->validate([
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users', 'username')->ignore($student->id)],
            'name' => 'nullable|string|max:255',
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($student->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8',
            'phone' => 'nullable|string|max:64',
            'address' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $this->updateModel($student, $validated, ['img']);

        if ($request->has('img')) {
            if ($student->img) {
                Storage::disk('public')->delete($student->img);
            }

            $filePath = $this->uploadImage($request->file('img'));
            $student->img = $filePath;
        }

        $student->save();

        return redirect()->route('admin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(int $id)
    {
        $student = User::findOrFail($id);

        if ($student->img) {
            Storage::disk('public')->delete($student->img);
        }

        $student->examResults()->delete();
        $student->groups()->detach();

        $student->delete();

        return response(null);
    }
}
