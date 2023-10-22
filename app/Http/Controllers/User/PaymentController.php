<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\SendLoginOtpRequest;
use App\Http\Requests\User\SignupRequest;
use App\Models\Plan;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = \auth()->user()->payments;

        return view('users.payment-history', compact('payments'));
    }
}
