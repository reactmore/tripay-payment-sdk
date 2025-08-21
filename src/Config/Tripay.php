<?php

namespace Reactmore\TripayPaymentSdk\Config;

use CodeIgniter\Config\BaseConfig;

class Tripay extends BaseConfig
{
   
    public string $stage = 'sandbox';

    public string $apiKey = '';
    
    public string $privateKey = '';
    
    public string $merchantCode = '';

    public function baseUrl(): string
    {
        return $this->stage === 'production'
            ? 'https://tripay.co.id/api/'
            : 'https://tripay.co.id/api-sandbox/';
    }
}
