<?php

namespace App\Services;

use Twilio\Rest\Client;

class MoyasarService
{
    protected $apiKey, $token, $twilioNumber, $clientService;

    public function __construct()
    {
        $this->apiKey = config('services.moyasar.secret_key');
    }

    public function createPayment($data)
    {

    }
}
