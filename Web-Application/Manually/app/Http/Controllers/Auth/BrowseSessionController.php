<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\DeviceSession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrowseSessionController extends Controller
{
    public function browseSession()
    {
        $user = Auth::user();
        $device_sessions = DeviceSession::where("user_id", $user->id)->get();
        return view("auth.browse-session", compact(['device_sessions','user']));
    }
}
