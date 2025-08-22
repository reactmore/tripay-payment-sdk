<?php

namespace Tests\Support;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Reactmore\TripayPaymentSdk\Config\Tripay as TripayConfig;
use Reactmore\TripayPaymentSdk\Tripay;

/**
 * @internal
 */
abstract class TestCase extends CIUnitTestCase
{
    use DatabaseTestTrait;

    /**
     * @var bool
     */
    protected $refresh = true;

    /**
     * @var array|string|null
     */
    protected $namespace = 'Reactmore\TripayPaymentSdk';

    protected TripayConfig $config;

    /**
     * Tripay instance preconfigured for testing
     */
    protected \Reactmore\TripayPaymentSdk\Tripay $tripay;

    protected function setUp(): void
    {
        parent::setUp();

        $this->config = new TripayConfig();
        $this->config->apiKey       = 'dummy_api_key';
        $this->config->privateKey   = 'dummy_private_key';
        $this->config->merchantCode = 'DUMMY123';
        
        $this->tripay = new Tripay($this->config);
    }
}
