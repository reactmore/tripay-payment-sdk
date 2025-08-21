<?php

namespace Reactmore\TripayPaymentSdk\HTTP;

use CodeIgniter\HTTP\CURLRequest;
use Config\Services;

abstract class BaseClient
{
    protected CURLRequest $http;
    protected array $defaultHeaders = [];
    protected string $baseUrl;
    protected int $timeout = 30;

    public function __construct(string $baseUrl, array $headers = [], int $timeout = 30)
    {
        $this->baseUrl  = rtrim($baseUrl, '/') . '/';
        $this->timeout  = $timeout;
        $this->defaultHeaders = array_merge([
            'Accept' => 'application/json',
        ], $headers);

        $this->http = Services::curlrequest([
            'baseURI'     => $this->baseUrl,
            'http_errors' => false,
            'headers'     => $this->defaultHeaders,
            'timeout'     => $this->timeout,
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

    public function put(string $uri, array $options = []): ResponseWrapper
    {
        $res = $this->http->put($uri, $options);
        return new ResponseWrapper($res);
    }

    public function delete(string $uri, array $options = []): ResponseWrapper
    {
        $res = $this->http->delete($uri, $options);
        return new ResponseWrapper($res);
    }
}
