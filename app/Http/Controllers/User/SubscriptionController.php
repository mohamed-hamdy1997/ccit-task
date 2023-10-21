<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Services\MoyasarService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribeToPlan($encryptedPlanId, Request $request)
    {
        $planId = decrypt($encryptedPlanId);
        $plan = Plan::query()->find($planId);
        $data = $request->all();

        if (!$plan || $plan->price != ($data['amount'] / 100)) {
            app(MoyasarService::class)->refundPayment($data['id']);

            return redirect()->route('user.homePage')->with('error', "Something went wrong during payment.");
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

            return redirect()->route('user.homePage')->with('success', "Subscribed to {$plan->name} plan successfully.");
        }

        return redirect()->route('user.homePage')->with('error', "Subscription failed ({$data['message']}).");
    }
}
