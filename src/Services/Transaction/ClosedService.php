<?php

namespace Reactmore\TripayPaymentSdk\Services\Transaction;

use Reactmore\TripayPaymentSdk\HTTP\Client;
use Reactmore\TripayPaymentSdk\HTTP\ResponseWrapper;
use Reactmore\TripayPaymentSdk\Services\BaseServices;
use Reactmore\TripayPaymentSdk\Config\Tripay as ConfigTripay;

class ClosedService extends BaseServices
{
    protected Client $client;

    protected ConfigTripay $config;

    public function __construct(Client $client, ConfigTripay $config)
    {
        parent::__construct($client, $config);
    }

    public function create(array $data): ResponseWrapper
    {
        $data['signature'] =  $this->createSignature($data['amount'], $data['merchant_ref']);
        return $this->client->post('transaction/create', [
            'form_params' => $data,
        ]);
    }

    public function detail(string $reference): ResponseWrapper
    {
        return $this->client->get('transaction/detail', [
            'query' => ['reference' => $reference]
        ]);
    }

    public function status(string $reference): ResponseWrapper
    {
        return $this->client->get('transaction/check-status', [
            'query' => ['reference' => $reference]
        ]);
    }

    public function createSignature($amount, string $merchant_ref)
    {
        return hash_hmac('sha256', $this->config->merchantCode . $merchant_ref . $amount, $this->config->privateKey);
    }
}
