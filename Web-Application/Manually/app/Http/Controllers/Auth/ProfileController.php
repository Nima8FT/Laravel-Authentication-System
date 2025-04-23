<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function showProfile()
    {
        $user = $this->user;
        return view("auth.profile", compact("user"));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $inputs = $request->only('name', 'email');
        $data = ['name' => $inputs['name']];

        if ($inputs['email'] !== $this->user->email) {
            $data['email'] = $inputs['email'];
            $data['email_verified_at'] = null;
            $data['remember_token'] = null;
        }

        $this->user->update($data);

        return redirect()->route("dashboard")->with("success", "Profile updated successfully.");
    }
}
