<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
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
        $userId = auth()->id();
        $moyasarService = app(MoyasarService::class);
        $paymentResponse = $moyasarService->getPayment($data['id']);
        $payment = $paymentResponse['data'];

        if ($paymentResponse['success'] && (!$plan || $plan->price != ($payment->amount / 100))) {
            Payment::query()->create([
                'user_id' => $userId,
                'payment_id' => $data['id'],
                'type' => Payment::TYPE['failed'],
                'amount' => $payment->amount / 100,
            ]);

            $refundResponse = $moyasarService->refundPayment($data['id']);

            if ($refundResponse['success']) {
                Payment::query()->create([
                    'user_id' => $userId,
                    'payment_id' => $data['id'],
                    'type' => Payment::TYPE['refund'],
                    'amount' => $refundResponse['data']->amount / 100,
                ]);
            } else {
                Payment::query()->create([
                    'user_id' => $userId,
                    'type' => Payment::TYPE['failed'],
                    'details' => $refundResponse['message'],
                ]);
            }


            return redirect()->route('user.homePage')->with('error', "Something went wrong during payment.");
        } else if (!$paymentResponse['success']) {
            Payment::query()->create([
                'user_id' => $userId,
                'type' => Payment::TYPE['failed'],
                'details' => $paymentResponse['message'],
            ]);

            return redirect()->route('user.homePage')->with('error', "Something went wrong during payment.");
        }

        if ($payment->status == 'paid') {
            Subscription::query()->updateOrCreate(['user_id' => $userId], [
                'user_id' => $userId,
                'plan_id' => $planId,
                'price' => $plan->price,
                'status' => Subscription::STATUSES['active'],
                'start' => now(),
                'end' => $plan->type == Plan::TYPE['annual'] ? now()->addYear() : now()->addMonth(),
            ]);

            Payment::query()->create([
                'user_id' => $userId,
                'payment_id' => $data['id'],
                'type' => Payment::TYPE['pay'],
                'amount' => $payment->amount / 100,
                'details' => $payment->description,
            ]);

            return redirect()->route('user.homePage')->with('success', "Subscribed to {$plan->name} plan successfully.");
        } else {
            Payment::query()->create([
                'user_id' => $userId,
                'payment_id' => $payment->id,
                'type' => Payment::TYPE['failed'],
                'amount' => $payment->amount / 100,
                'details' => "{$payment->status} to subscribed to {$plan->name} plan",
            ]);
        }

        return redirect()->route('user.homePage')->with('error', "Subscription failed ({$data['message']}).");
    }
}
