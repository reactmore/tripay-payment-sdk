<?php

namespace Reactmore\TripayPaymentSdk\Exceptions;

class TransactionsException extends TripayException
{
    protected array $response;

    public function __construct(string $message, int $code = 0, array $response = [], \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    public function getResponse(): array
    {
        return $this->response;
    }
}
