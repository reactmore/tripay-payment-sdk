<?php

namespace Reactmore\TripayPaymentSdk\Services;

use Reactmore\TripayPaymentSdk\Config\Tripay as ConfigTripay;
use Reactmore\TripayPaymentSdk\HTTP\Client;

abstract class BaseServices
{
    protected Client $client;

    protected ConfigTripay $config;

    public function __construct(Client $client, ConfigTripay $config)
    {
        $this->client = $client;
        $this->config = $config;
    }
}
