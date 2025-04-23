<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Models\DeviceSession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function create()
    {
        return view("auth.register");
    }

    public function store(RegisterRequest $request)
    {
        try {

            $inputs = $request->only('name', 'email', 'password');
            $inputs['password'] = Hash::make($inputs['password']);

            $user = User::create($inputs);

            Auth::login($user);

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

            return redirect()->route('dashboard')->with('success', 'register successfully');
        } catch (\Exception $e) {
            return redirect()
                ->route('register.create')
                ->with('error', 'not register please try again' . $e->getMessage());
        }
    }
}
