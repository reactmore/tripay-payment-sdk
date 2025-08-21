<?php

namespace Reactmore\TripayPaymentSdk\Services;

use Reactmore\TripayPaymentSdk\HTTP\Client;
use Reactmore\TripayPaymentSdk\HTTP\ResponseWrapper;

abstract class BaseService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function get(string $uri, array $params = []): ResponseWrapper
    {
        return $this->client->get($uri, ['query' => $params]);
    }

    protected function post(string $uri, array $data = []): ResponseWrapper
    {
        return $this->client->post($uri, ['form_params' => $data]);
    }
}
