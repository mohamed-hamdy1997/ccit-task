<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Moyasar\Providers\PaymentService;
use Twilio\Rest\Client;

class MoyasarService
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        \Moyasar\Moyasar::setApiKey(config('services.moyasar.secret_key'));
        $this->paymentService = $paymentService;
    }

    public function refundPayment($paymentId)
    {
        try {
            $payment = $this->paymentService->fetch($paymentId);
            $payment->refund($payment->amount);
        } catch (\Throwable $exception) {
            Log::critical($exception->getMessage());
        }
    }
}
