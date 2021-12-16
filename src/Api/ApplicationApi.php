<?php


namespace LaravelPagSeguro\Api;

use LaravelPagSeguro\Api;
use LaravelPagSeguro\Configuration;

class ApplicationApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function createApplication($data)
    {
        $path = 'oauth2/application';
        return $this->post($this->configuration->getAccessToken(), $path, $data);
    }

    public function getApplication(string $client_id)
    {
        $path = "oauth2/application/{$client_id}";
        return $this->get($this->configuration->getAccessToken(), $path);
    }
}
