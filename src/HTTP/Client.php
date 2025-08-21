<?php

namespace Reactmore\TripayPaymentSdk\HTTP;

use Reactmore\TripayPaymentSdk\Config\Tripay as TripayConfig;

class Client extends BaseClient
{
    protected TripayConfig $config;

    public function __construct(TripayConfig $config)
    {
        $this->config = $config;

        parent::__construct(
            $this->config->baseUrl(),
            [
                'Authorization' => 'Bearer ' . $this->config->apiKey,
            ],
            30
        );
    }
}
