<?php

namespace Reactmore\TripayPaymentSdk\Services\Transaction;

use Reactmore\TripayPaymentSdk\HTTP\Client;
use Reactmore\TripayPaymentSdk\HTTP\ResponseWrapper;

class OpenService implements TransactionInterface
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create(array $data): ResponseWrapper
    {
        return $this->client->post('/open-payment/create', $data);
    }

    public function detail(string $reference): ResponseWrapper
    {
        return $this->client->get("/open-payment/{$reference}/detail");
    }

    public function status(array $payload): ResponseWrapper
    {
        return $this->client->get("/open-payment/{$payload['reference']}/transactions", $payload);
    }
}
