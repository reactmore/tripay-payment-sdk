<?php

namespace Reactmore\TripayPaymentSdk\HTTP;

use CodeIgniter\HTTP\ResponseInterface;
use Reactmore\TripayPaymentSdk\Exceptions\InvalidResponseException;

class ResponseWrapper
{
    protected ResponseInterface $response;
    protected mixed $decoded; // object or array

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;

        $body = (string) $response->getBody();
        $decoded = json_decode($body);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // simpan fallback object standar
            $this->decoded = (object) [
                'status_code' => $response->getStatusCode(),
                'success'    => false,
                'message'    => 'Invalid JSON from Tripay',
                'raw'        => $body,
            ];
        } else {
            // tambahkan httpStatus agar selalu ada
            $decoded->status_code = $response->getStatusCode();
            $this->decoded = $decoded;
        }
    }

    /**
     * Default: return decoded object
     */
    public function get(): object
    {
        return $this->decoded;
    }

    /**
     * Convert response to array
     */
    public function toArray(): array
    {
        return json_decode(json_encode($this->decoded), true);
    }

    /**
     * Convert response to json string
     */
    public function toJson(): string
    {
        return json_encode($this->decoded);
    }

    /**
     * Get raw CI ResponseInterface
     */
    public function raw(): ResponseInterface
    {
        return $this->response;
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * Magic: akses langsung property dari decoded object
     */
    public function __get(string $name)
    {
        return $this->decoded->$name ?? null;
    }

    /**
     * Magic: return JSON kalau di-cast ke string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
