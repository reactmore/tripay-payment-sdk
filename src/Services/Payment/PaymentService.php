<?php

namespace Reactmore\TripayPaymentSdk\Services\Payment;

use Reactmore\TripayPaymentSdk\HTTP\Client;
use Reactmore\TripayPaymentSdk\HTTP\ResponseWrapper;

class PaymentService implements PaymentInterface
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getInstruction(array $payload): ResponseWrapper
    {
        return $this->client->get('payment/instruction', $payload);
    }
}
