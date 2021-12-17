<?php

namespace LaravelPagSeguro;

use LaravelPagSeguro\Configuration;
use Illuminate\Support\Facades\Http;

class SoapApi
{

    private $url;
    private $default_query;
    private const default_headers = [
        'content-type' => 'application/xml',
        'accept' => 'application/xml; charset=ISO-8859-1'
    ];

    public function __construct()
    {
        $this->url = config('pagseguro.sandbox') ? config('pagseguro.host.soap_sandbox') : config('pagseguro.host.soap_production');
        $this->default_query = [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
        ];
    }

    public function get(String $access_token, String $path, array $query = null)
    {
        $response = Http::withHeaders(self::default_headers)->withToken($access_token)->get($this->url . $path, array_merge($this->default_query, $query));

        return $this->convertXMLResponseIntoJson($response->getBody());
    }

    public function post(string $access_token, string $path, $data)
    {
        $response = Http::withHeaders(self::default_headers)->withToken($access_token)->post($this->url . $path, $data);

        return $this->convertXMLResponseIntoJson($response->getBody());
    }

    public function put(string $access_token, string $path, $data)
    {
        $response = Http::withHeaders(self::default_headers)->withToken($access_token)->put($this->url . $path, $data);

        return $this->convertXMLResponseIntoJson($response->getBody());
    }

    public function delete(string $access_token, $path)
    {
        $response = Http::withHeaders(self::default_headers)->withToken($access_token)->delete($this->url . $path);

        return $this->convertXMLResponseIntoJson($response->getBody());
    }

    private function convertXMLResponseIntoJson(string $response)
    {
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        return json_decode($json, true);
    }
}
