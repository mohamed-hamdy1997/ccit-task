<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\SendLoginOtpRequest;
use App\Http\Requests\User\SignupRequest;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(SignupRequest $request)
    {
        User::query()->create($request->validated());

        return redirect()->route('user.login.view');
    }

    public function sendLoginOtp(SendLoginOtpRequest $request)
    {
        $phone = $request->validated()['phone_number'];
        $otp = rand(1000, 9999);
        Cache::put("login-otp-{$phone}", $otp, now()->addSeconds(30));
        app(TwilioService::class)->sendSms("+2{$phone}", "Your CCIT OTP Is: {$otp}");

        return returnResponse([], 'success');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $cachedOtp = Cache::get("login-otp-{$data['phone_number']}");

        if (!$cachedOtp){
            return redirect()->back()->with('error', "OTP Expired");
        }

        if ($data['otp'] != $cachedOtp) {
            return redirect()->back()->with('error', "Wrong OTP.");
        }

        $user = User::query()->user()->wherePhoneNumber($data['phone_number'])->first();

        Auth::login($user);

        return redirect()->route('user.homePage');
    }

    public function logout()
    {
        \auth()->logout();

        return redirect()->route('user.login.view');
    }
}
