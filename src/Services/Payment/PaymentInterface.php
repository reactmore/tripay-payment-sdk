<?php

namespace Reactmore\TripayPaymentSdk\Services\Payment;

use Reactmore\TripayPaymentSdk\HTTP\ResponseWrapper;

interface PaymentInterface
{
    public function getInstruction(array $payload): ResponseWrapper;
}
