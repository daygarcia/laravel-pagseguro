<?php


namespace LaravelPagSeguro\Api;

use DayGarcia\LaravelMercadoLivre\Configuration;
use LaravelPagSeguro\SoapApi;

class NotificationApi extends SoapApi
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getNotification(string $notification_code)
    {
        $path = "v3/transactions/notifications/{$notification_code}";
        return $this->get($this->configuration->getAccessToken(), $path);
    }
}
