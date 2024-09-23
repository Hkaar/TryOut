<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Traits\Modelor;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use Modelor;
     
    /**
     * Display a listing of the resource.
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
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $student = new User;
        $student->fill($validated);

        $role = Role::StrictByName('student')->first()->id;
        $student->role_id = $role;

        if ($request->has('img')) {
           $filePath = $this->uploadImage($request->get('img'));
           $student->img = $filePath;
        }

        $student->save();

        return redirect()->route('admin.students.index');
    }

    /**
     * Display the specified resource.
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
     */
    public function update(Request $request, int $id)
    {
        $student = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'nullable|string|max:255|unique:users,username',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $this->updateModel($student, $validated, ['img']);

        if ($request->has('img')) {
           $filePath = $this->uploadImage($request->get('img'));
           $student->img = $filePath;
        }

        $student->save();

        return redirect()->route('admin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $student = User::findOrFail($id);

        $student->examResults()->delete();
        $student->groups()->detach();

        $student->delete();

        return response(null);
    }
}
