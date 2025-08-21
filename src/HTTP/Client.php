<?php

namespace Reactmore\TripayPaymentSdk\HTTP;

use CodeIgniter\HTTP\CURLRequest;
use Config\Services;
use Reactmore\TripayPaymentSdk\Config\Tripay as TripayConfig;

class Client
{
    protected TripayConfig $config;
    protected CURLRequest $http;

    public function __construct(TripayConfig $config)
    {
        $this->config = $config;

        $this->http = Services::curlrequest([
            'baseURI'     => rtrim($config->baseUrl(), '/') . '/',
            'http_errors' => false,
            'headers'     => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $this->config->apiKey,
            ],
            'timeout' => 30,
        ]);
    }

    public function get(string $uri, array $options = []): ResponseWrapper
    {
        $res = $this->http->get($uri, $options);

        return new ResponseWrapper($res);
    }

    public function post(string $uri, array $options = []): ResponseWrapper
    {
        $res = $this->http->post($uri, $options);

        return new ResponseWrapper($res);
    }
}
