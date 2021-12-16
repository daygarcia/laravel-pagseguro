<?php

namespace LaravelPagSeguro\Api\Checkout;

use LaravelPagSeguro\Api;
use LaravelPagSeguro\Configuration;

class CreditCard extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function create(array $data)
    {
        $url = 'v2/checkout';
        return $this->post($this->configuration->getAccessToken(), $url, $data);
    }
}
