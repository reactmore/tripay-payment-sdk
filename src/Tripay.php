<?php

namespace Reactmore\TripayPaymentSdk;

use Reactmore\TripayPaymentSdk\Config\Tripay as TripayConfig;
use Reactmore\TripayPaymentSdk\Exceptions\TransactionsException;
use Reactmore\TripayPaymentSdk\Exceptions\TripayException;
use Reactmore\TripayPaymentSdk\HTTP\Client;
use Reactmore\TripayPaymentSdk\Services\Merchant\MerchantService;
use Reactmore\TripayPaymentSdk\Services\Payment\PaymentService;
use Reactmore\TripayPaymentSdk\Services\Transaction\ClosedService;
use Reactmore\TripayPaymentSdk\Services\Transaction\OpenService;

class Tripay
{
    protected TripayConfig $config;
    protected Client $client;

    public function __construct(TripayConfig $config)
    {
        $this->validateConfig($config);

        $this->config = $config;
        $this->client = new Client($config);
    }

    protected function validateConfig(TripayConfig $config): void
    {
        if (empty($config->apiKey)) {
            throw new TripayException("API Key tidak boleh kosong.");
        }

        if (empty($config->privateKey)) {
            throw new TripayException("Private Key tidak boleh kosong.");
        }

        if (empty($config->merchantCode)) {
            throw new TripayException("Merchant Code tidak boleh kosong.");
        }
    }

    public function merchant(): MerchantService
    {
        return new MerchantService($this->client);
    }

    public function transaction(string $transactionType = 'closed')
    {
        if ($transactionType === 'open') {
            return new OpenService($this->client, $this->config);
        }

        if ($transactionType === 'closed') {
            return new ClosedService($this->client, $this->config);
        }

        throw new TransactionsException('metode yang digunakan tidak didukung.');
    }

    public function payment(): PaymentService
    {
        return new PaymentService($this->client);
    }

    /**
     * Verify callback signature
     */
    

    /**
     * Verify callback signature
     */
    public function verifyCallback(string $rawBody, string $signatureHeader, ?string $eventHeader = null): bool
    {
        if ($eventHeader !== null && $eventHeader !== 'payment_status') {
            return false;
        }

        $calc = hash_hmac('sha256', $rawBody, $this->config->privateKey);

        return hash_equals($calc, $signatureHeader);
    }
}
