<?php


namespace LaravelPagSeguro;

use Illuminate\Support\Facades\Http;

class Configuration
{
    private const URL = 'https://api.mercadolibre.com/';

    private $code;
    private $client_id;
    private $secret;
    private $access_token;
    private $refresh_token;
    private $type;
    private $redirect_uri;
    private $user_id;
    private $errors = [];

    public function __construct(array $config)
    {
        $this->code = $config['code'] ?? null;
        $this->client_id = $config['client_id'] ?? null;
        $this->secret = $config['secret'] ?? null;
        $this->access_token = $config['access_token'] ?? null;
        $this->refresh_token = $config['refresh_token'] ?? null;
        $this->type = $config['type'] ?? null;
        $this->redirect_uri = $config['redirect_uri'] ?? null;

        !empty($this->access_token) ? $this->setAccessToken($this->access_token) : $this->authorize();
    }

    public function authorize(): void
    {
        $authorization_type = array(
            'renew' => array(
                'body'  => [
                    'grant_type'    => 'refresh_token',
                    'client_id'     => $this->client_id,
                    'client_secret' => $this->secret,
                    'refresh_token' => $this->refresh_token
                ]
            ),
            'new'   => array(
                'body'  => [
                    'grant_type'        => 'authorization_code',
                    'client_id'         => $this->client_id,
                    'client_secret'     => $this->secret,
                    'code'              => $this->code,
                    'redirect_uri'      => $this->redirect_uri
                ]
            )
        );

        $response = Http::withHeaders(
            [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: application/json'
            ]
        )->post(
            self::URL . '/oauth/token',
            $authorization_type[$this->type]['body']
        )->object();

        if (isset($response->refresh_token)) {
            $this->setAccessToken($response->access_token);
            $this->setRefreshToken($response->refresh_token);
            isset($response->user_id) ? $this->setUserId($response->user_id) : null;
        } else if (isset($response->access_token)) {
            $this->setAccessToken($response->access_token);
            isset($response->user_id) ? $this->setUserId($response->user_id) : null;
        } else {
            $this->setErrors([$response->error, $response->message]);
            $this->setErrorCode($response->status);
        }
    }

    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function setRefreshToken(string $refresh_token): void
    {
        $this->refresh_token = $refresh_token;
    }

    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setUserId(float $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getUserId(): float
    {
        return $this->user_id;
    }

    public function setErrorCode(float $error_code): void
    {
        $this->error_code = $error_code;
    }

    public function getErrorCode(): float
    {
        return $this->error_code;
    }
}
