<?php

namespace App\Http\Controllers;

use App\Http\Requests\login\LoginRequest;
use function session;
use function toast;

class LoginController extends Controller
{
    public function login()
    {
        return view('pages.login.login');
    }

    public function loginProcess(LoginRequest $request)
    {

        $credentials = $request->only(['email', 'password']);
        if (auth()->attempt($credentials)) {
            toast(__('alert.welcome_back'), 'success');
            return redirect()->route('home');
        }
        toast(__('alert.invalid_credentials'), 'error');
        return redirect()->back()->with('error', __('alert.invalid_credentials'));
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();
        session()->regenerate();
        return redirect()->route('login-page');
    }
}
