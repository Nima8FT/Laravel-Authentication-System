<?php

namespace App\Http\Controllers\Auth;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Models\DeviceSession;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

            //captcha
            $response = Http::asForm()->post('https://hcaptcha.com/siteverify', [
                'secret' => 'ES_f05ab02ddc424bbabca7e82b79f1c09f',
                'response' => $request->input('h-captcha-response'),
                'remoteip' => $request->ip(),
            ]);

            $verification = $response->json();

            if (!isset($verification['success']) || $verification['success'] !== true) {
                return back()->withErrors(['error' => 'captcha is not correct']);
            }

            if (!Auth::attempt($credentials, $remember)) {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            //browse session 
            $agent = new Agent();
            $user = Auth::user();

            DeviceSession::create([
                'user_id' => $user->id,
                'session_id' => session()->getId(),
                'browser' => $agent->browser(),
                'os' => $agent->platform(),
                'device' => $agent->device(),
                'is_mobile' => $agent->isMobile()
            ]);

            return redirect()->route('dashboard')->with("success", "login successfully");
        } catch (\Exception $e) {
            return redirect()
                ->route('login.create')
                ->with('error', 'not login please try again' . $e->getMessage());
        }
    }
}
