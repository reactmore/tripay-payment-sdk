<?php

namespace Reactmore\TripayPaymentSdk\Services\Merchant;

use Reactmore\TripayPaymentSdk\HTTP\ResponseWrapper;

interface MerchantInterface
{
    public function getChannel(): ResponseWrapper;

    public function getFeeCalculator(array $params): ResponseWrapper;

    public function getTransactionList(array $params = []): ResponseWrapper;
}
