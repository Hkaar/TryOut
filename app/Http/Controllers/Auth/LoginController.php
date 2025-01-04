<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login page
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle the login attempt
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if (! $user) {
            return redirect()->to('login')
                ->withErrors(['username' => 'Username atau email yang dimasukkan salah!']);
        }

        if (! Auth::validate($credentials)) {
            return redirect()->to('login')
                ->withErrors(['password' => 'Password yang dimasukkan salah!']);
        }

        Auth::login($user, $request->get('remember'));

        return redirect()->intended(route('home'));
    }
}
