<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Modelor;
use App\Traits\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use Uploader, Modelor;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
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
            'role_id' => 'required|numeric|exists:roles,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $user = new User;
        $user->fill($validated);

        if ($request->has('img')) {
           $filePath = $this->uploadImage($request->get('img'));
           $user->img = $filePath;
        }

        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'nullable|string|max:255|unique:users,username',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8',
            'role_id' => 'required|numeric|exists:roles,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $this->updateModel($user, $validated, ['img']);

        if ($request->has('img')) {
            if ($user->img) {
                Storage::disk('public')->delete($user->img);
            }

            $filePath = $this->uploadImage($request->get('img'));
            $user->img = $filePath;
        }

        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        $user->groups()->detach();
        $user->examResults()->delete();

        $user->delete();

        return response(null);
    }
}
