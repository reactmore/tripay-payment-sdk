<?php

namespace Reactmore\TripayPaymentSdk\HTTP;

use CodeIgniter\HTTP\ResponseInterface;

class ResponseWrapper
{
    protected ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function toArray(): array
    {
        $body = (string) $this->response->getBody();
        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'success'    => false,
                'message'    => 'Invalid JSON from Tripay',
                'httpStatus' => $this->response->getStatusCode(),
                'raw'        => $body,
            ];
        }

        return $data + ['httpStatus' => $this->response->getStatusCode()];
    }

    public function toJson(): string
    {
        return (string) $this->response->getBody();
    }

    public function toObject(): ResponseInterface
    {
        return $this->response;
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function __toString(): string
    {
        return $this->toJson();
    }
}
