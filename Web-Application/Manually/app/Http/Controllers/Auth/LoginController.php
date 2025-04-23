<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view("auth.login");
    }

    public function store(LoginRequest $request)
    {
        try {
            $credentials = $request->only("email", "password");

            $remember = $request->has('remember');

            if (!Auth::attempt($credentials, $remember)) {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->route('dashboard')->with("success", "login successfully");
        } catch (\Exception $e) {
            return redirect()
                ->route('login.create')
                ->with('error', 'not login please try again' . $e->getMessage());
        }
    }
}
