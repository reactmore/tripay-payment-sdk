<?php

namespace Reactmore\TripayPaymentSdk\Services\Transaction;

use Reactmore\TripayPaymentSdk\Config\Tripay as ConfigTripay;
use Reactmore\TripayPaymentSdk\HTTP\Client;
use Reactmore\TripayPaymentSdk\HTTP\ResponseWrapper;

class OpenService extends TransactionInterface
{
    protected Client $client;

    protected ConfigTripay $config;

    public function __construct(Client $client, ConfigTripay $config)
    {
        parent::__construct($client, $config);
    }

    public function create(array $data): ResponseWrapper
    {
        $data['signature'] =  $this->createSignature($data['method'], $data['merchant_ref']);

        return $this->client->post('open-payment/create', [
            'form_params' => $data,
        ]);
    }

    public function detail(string $reference): ResponseWrapper
    {
        return $this->client->get("open-payment/{$reference}/detail");
    }

    public function listTransactions(array $payload = []): ResponseWrapper
    {
        return $this->client->get(
            "open-payment/{$payload['reference']}/transactions",
            [
                'query' => $payload
            ]
        );
    }

    public function createSignature(string $channel, string $merchantRef)
    {
        return hash_hmac('sha256', $this->config->merchantCode . $channel . $merchantRef, $this->config->privateKey);
    }
}
