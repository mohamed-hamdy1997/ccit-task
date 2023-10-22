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

    public function getPayment($paymentId)
    {
        try {
            $res['data'] = $this->paymentService->fetch($paymentId);
            $res['success'] = true;

            return $res;
        } catch (\Throwable $exception) {
            Log::critical($exception->getMessage());
            $res['message'] = $exception->getMessage();
            $res['success'] = false;

            return $res;
        }
    }

    public function refundPayment($paymentId)
    {
        try {
            $payment = $this->paymentService->fetch($paymentId);
            $payment->refund($payment->amount);

            $res['data'] = $payment;
            $res['success'] = true;

            return $res;
        } catch (\Throwable $exception) {
            Log::critical($exception->getMessage());
            $res['message'] = $exception->getMessage();
            $res['success'] = false;

            return $res;
        }
    }
}
