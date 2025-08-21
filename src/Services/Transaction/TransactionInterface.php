<?php

namespace Reactmore\TripayPaymentSdk\Services\Transaction;

use Reactmore\TripayPaymentSdk\HTTP\ResponseWrapper;

interface TransactionInterface
{
    public function create(array $data): ResponseWrapper;

    public function detail(string $reference): ResponseWrapper;

    public function status(array $payload): ResponseWrapper;
}
