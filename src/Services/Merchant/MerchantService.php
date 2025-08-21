<?php

namespace Reactmore\TripayPaymentSdk\Services\Merchant;

use Reactmore\TripayPaymentSdk\HTTP\Client;
use Reactmore\TripayPaymentSdk\HTTP\ResponseWrapper;
use Reactmore\TripayPaymentSdk\Validation\PayloadValidator;

class MerchantService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getChannel(): ResponseWrapper
    {
        return $this->client->get('/merchant/payment-channel');
    }

    public function getFeeCalculator(array $payload = []): ResponseWrapper
    {
        PayloadValidator::validate($payload, [
            'amount'    => 'numeric',
        ]);

        return $this->client->get('/merchant/fee-calculator', $payload);
    }

    public function getTransactionList(array $payload = []): ResponseWrapper
    {
        return $this->client->get('/merchant/transactions', $payload);
    }
}
