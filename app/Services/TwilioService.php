<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $sid, $token, $twilioNumber, $clientService;

    public function __construct()
    {
        $this->sid = config('services.twilio.sid');
        $this->token = config('services.twilio.token');
        $this->twilioNumber = config('services.twilio.phone_number');
        $this->clientService = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }

    public function sendSms($toNumber, $msg)
    {
        $this->clientService->messages->create($toNumber, ['body' => $msg, 'from' => $this->twilioNumber]);
    }
}
