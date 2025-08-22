<?php

namespace Tests;

use Tests\Support\TestCase;
use Reactmore\TripayPaymentSdk\Services\Merchant\MerchantService;
use Reactmore\TripayPaymentSdk\Services\Payment\PaymentService;
use Reactmore\TripayPaymentSdk\Services\Transaction\ClosedService;
use Reactmore\TripayPaymentSdk\Services\Transaction\OpenService;
use Reactmore\TripayPaymentSdk\Exceptions\TransactionsException;

final class ServiceTest extends TestCase
{
    public function testMerchantServiceInstance(): void
    {
        $merchant = $this->tripay->merchant();
        $this->assertInstanceOf(MerchantService::class, $merchant);
    }

    public function testPaymentServiceInstance(): void
    {
        $payment = $this->tripay->payment();
        $this->assertInstanceOf(PaymentService::class, $payment);
    }

    public function testTransactionClosedServiceInstance(): void
    {
        $closed = $this->tripay->transaction('closed');
        $this->assertInstanceOf(ClosedService::class, $closed);
    }

    public function testTransactionOpenServiceInstance(): void
    {
        $open = $this->tripay->transaction('open');
        $this->assertInstanceOf(OpenService::class, $open);
    }

    public function testTransactionThrowsExceptionForInvalidType(): void
    {
        $this->expectException(TransactionsException::class);
        $this->tripay->transaction('invalid-type');
    }
}
