<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function logout(Request $request)
    {
        $this->user->update([
            'verify2fa' => 0,
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'logout successfully');
    }

    public function deleteAccount(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $this->user->delete();

        return redirect()->route('login')->with('success', 'Your account has been deleted successfully.');
    }
}
