<?php

namespace LaravelPagSeguro\Api;

use LaravelPagSeguro\Api;
use LaravelPagSeguro\Configuration;

class Charge extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function createCharge(array $data)
    {
        $path = 'charges';
        return $this->post($this->configuration->getAccessToken(), $path, $data);
    }

    public function captureCharge(string $code, array $data)
    {
        $path = "charges/{$code}/capture";
        return $this->post($this->configuration->getAccessToken(), $path, $data);
    }

    public function cancelCharge(string $code, array $data)
    {
        $path = "charges/{$code}/cancel";
        return $this->post($this->configuration->getAccessToken(), $path, $data);
    }

    public function getCharge(string $charge_id)
    {
        $path = "charges/{$charge_id}";
        return $this->get($this->configuration->getAccessToken(), $path);
    }

    public function getChargeByReferenceId(string $reference_id)
    {
        $path = "charges?reference_id={$reference_id}";
        return $this->get($this->configuration->getAccessToken(), $path);
    }
}
