<?php

namespace Reactmore\TripayPaymentSdk;

use Reactmore\TripayPaymentSdk\Config\Tripay as TripayConfig;
use Reactmore\TripayPaymentSdk\HTTP\Client;
use Reactmore\TripayPaymentSdk\Services\Merchant\MerchantService;
use Reactmore\TripayPaymentSdk\Services\Payment\PaymentService;
use Reactmore\TripayPaymentSdk\Services\Transaction\TransactionService;
use Reactmore\TripayPaymentSdk\Exceptions\TransactionsException;

class Tripay
{
    protected TripayConfig $config;
    protected Client $client;

    public function __construct(TripayConfig $config)
    {
        $this->config = $config;
        $this->client = new Client($config);
    }

    public function merchant(): MerchantService
    {
        return new MerchantService($this->client);
    }


    public function transaction(string $transactionType = 'closed'): TransactionService
    {
        if ($transactionType == 'open') {
            return new TransactionService($this->client);
        }
        
        if ($transactionType == 'closed') {
            return new TransactionService($this->client);
        }

        throw new TransactionsException("metode yang digunakan tidak didukung.");

    }

    public function payment(): PaymentService
    {
        return new PaymentService($this->client);
    }

    /**
     * Optional: magic call fallback
     */
    public function __call($name, $arguments)
    {
        $map = [
            'merchant'    => MerchantService::class,
            'transaction' => TransactionService::class,
            'payment'     => PaymentService::class,
        ];

        if (isset($map[$name])) {
            return new $map[$name]($this->client);
        }

        throw new \BadMethodCallException("Method {$name} not found.");
    }

    /** Verify callback signature */
    public function verifyCallback(string $rawBody, string $signatureHeader, ?string $eventHeader = null): bool
    {
        if ($eventHeader !== null && $eventHeader !== 'payment_status') {
            return false;
        }

        $calc = hash_hmac('sha256', $rawBody, $this->config->privateKey);
        return hash_equals($calc, $signatureHeader);
    }
}
