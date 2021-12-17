<?php


namespace LaravelPagSeguro\Api;

use LaravelPagSeguro\Configuration;
use LaravelPagSeguro\SoapApi;

class NotificationApi extends SoapApi
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        parent::__construct();
    }

    public function getNotification(string $notification_code)
    {
        $path = "v3/transactions/notifications/{$notification_code}";
        return $this->get($this->configuration->getAccessToken(), $path);
    }
}
