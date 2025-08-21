<?php

namespace Reactmore\TripayPaymentSdk\Exceptions;

use Exception;

class TripayException extends Exception
{
    protected ?int $statusCode = null;
    protected array $response = [];

    public function __construct(
        string $message,
        int $code = 0,
        ?int $statusCode = null,
        array $response = [],
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->statusCode = $statusCode;
        $this->response   = $response;
    }

    /**
     * Ambil status code HTTP
     */
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * Ambil response body asli (jika ada)
     */
    public function getResponse(): array
    {
        return $this->response;
    }
}
