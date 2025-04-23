<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\DeviceSession;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        DeviceSession::where('session_id', session()->getId())->delete();

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

        DeviceSession::where('user_id', $this->user->id)->delete();

        $this->user->delete();

        return redirect()->route('login')->with('success', 'Your account has been deleted successfully.');
    }

    public function logoutOtherDevice(Request $request)
    {
        $currentSessionId = Session::getId();

        DB::table('sessions')
            ->where('user_id', $this->user->id)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        DeviceSession::where('user_id', $this->user->id)
            ->where('session_id', '!=', $currentSessionId)
            ->delete();

        return back()->with('success', 'logout other system successfully');
    }
}
