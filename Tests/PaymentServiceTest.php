<?php

namespace Tests\Services\Payment;

use CodeIgniter\Test\CIUnitTestCase;
use Reactmore\TripayPaymentSdk\HTTP\Client;
use Reactmore\TripayPaymentSdk\HTTP\ResponseWrapper;
use Reactmore\TripayPaymentSdk\Services\Payment\PaymentService;

class PaymentServiceTest extends CIUnitTestCase
{
    public function testGetInstructionCallsClientGet(): void
    {
        $payload = ['method' => 'BRIVA'];

        // Buat dummy ResponseWrapper
        $fakeResponse = $this->createMock(ResponseWrapper::class);

        // Mock Client
        $mockClient = $this->createMock(Client::class);

        // Ekspektasi: Client::get() dipanggil sekali dengan argumen sesuai
        $mockClient->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo('payment/instruction'),
                $this->equalTo($payload)
            )
            ->willReturn($fakeResponse);

        $service = new PaymentService($mockClient);
        $result  = $service->getInstruction($payload);

        $this->assertSame($fakeResponse, $result);
    }
}
