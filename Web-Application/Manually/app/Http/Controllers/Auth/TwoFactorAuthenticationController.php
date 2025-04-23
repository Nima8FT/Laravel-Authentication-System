<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Enable2FARequest;
use App\Http\Requests\SecretCode2FARequest;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthenticationController extends Controller
{
    public $google2fa;
    public $user;

    public function __construct()
    {
        $this->google2fa = app('pragmarx.google2fa');
        $this->user = Auth::user();
    }

    public function enable2FAShow()
    {
        $secret = $this->google2fa->generateSecretKey();

        $urlQRCode = $this->google2fa->getQRCodeInline(
            config('app.name'),
            $this->user->email,
            $secret
        );

        return view("auth.enable-2fa", compact(['secret', 'urlQRCode']));
    }

    public function enable2FA(Enable2FARequest $request)
    {
        $inputs = $request->only('otp', 'secret');
        $valid = $this->google2fa->verifyKey($inputs['secret'], $inputs['otp']);

        if ($valid) {
            $this->user->update([
                'google2fa_secret' => $inputs['secret'],
            ]);
        }

        return redirect()->route('dashboard')->with('success', '2fa is verified');
    }

    public function disable2FA()
    {
        $this->user->update([
            'google2fa_secret' => null,
            'verify2fa' => 0,
        ]);
        return redirect()->route('dashboard');
    }

    public function secretCodeShow()
    {
        return view('auth.secret-code');
    }

    public function secretCode(SecretCode2FARequest $request)
    {
        $secret = $this->user->google2fa_secret;
        $otp = $request->only('code');
        $valid = $this->google2fa->verifyKey($secret, $otp['code']);

        if ($valid) {
            $this->user->update([
                'verify2fa' => 1,
            ]);
            return redirect()->route('dashboard')->with('google2fa', '2fa is verify');
        }
        return redirect()->back()->withErrors(['code' => 'secret code is wrong']);
    }
}
