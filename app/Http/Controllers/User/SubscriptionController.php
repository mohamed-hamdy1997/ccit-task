<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\SendLoginOtpRequest;
use App\Http\Requests\User\SignupRequest;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class SubscriptionController extends Controller
{
    public function subscribeToPlan($encryptedPlanId, Request $request)
    {
        $planId = decrypt($encryptedPlanId);
        $plan = Plan::query()->find($planId);
        if (!$plan) {
//            error & refund
        }
        $data = $request->all();

        if ($plan->price != ($data['amount'] / 100)) {
            //            error & refund
        }

        if ($data['status'] == 'paid' && $data['message'] == 'APPROVED') {
            Subscription::query()->updateOrCreate(['user_id' => \auth()->id()], [
                'user_id' => \auth()->id(),
                'plan_id' => $planId,
                'price' => $plan->price,
                'status' => Subscription::STATUSES['active'],
                'start' => now(),
                'end' => $plan->type == Plan::TYPE['annual'] ? now()->addYear() : now()->addMonth(),
            ]);
        }

        return redirect()->route('user.homePage')->with('success', "Subscribed to {$plan->name} plan successfully.");
    }
}
