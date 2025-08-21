<?php

namespace Reactmore\TripayPaymentSdk\Config;

use CodeIgniter\Config\BaseService;
use Reactmore\TripayPaymentSdk\Config\Tripay as TripayConfig;
use Reactmore\TripayPaymentSdk\Tripay as TripayService;

class Services extends BaseService
{
    public static function tripay(?TripayConfig $config = null, bool $getShared = true): TripayService
    {
        if ($getShared) {
            return static::getSharedInstance('tripay', $config);
        }

        return new TripayService($config ?? config('Tripay'));
    }
}
