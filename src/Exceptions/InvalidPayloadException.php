<?php

namespace Reactmore\TripayPaymentSdk\Exceptions;

class InvalidPayloadException extends TripayException
{
    protected array $errors = [];

    public function __construct(array $errors, string $message = "Invalid payload")
    {
        $this->errors = $errors;

        // bikin message gabungan
        $detail = [];
        foreach ($errors as $field => $messages) {
            foreach ($messages as $msg) {
                $detail[] = $msg;
            }
        }

        $fullMessage = $message . ': ' . implode("; ", $detail);

        parent::__construct($fullMessage, 0, 400, [
            'errors' => $errors
        ]);
    }

    /**
     * Ambil daftar error validasi
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Format error jadi string (untuk log/debug)
     */
    public function getErrorsAsString(): string
    {
        $lines = [];
        foreach ($this->errors as $field => $messages) {
            foreach ($messages as $msg) {
                $lines[] = $msg;
            }
        }
        return implode("; ", $lines);
    }
}
