<?php

namespace LaravelPagSeguro;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class Api
{
    private $url;
    private const api_version = '4.0';
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->url = config('pagseguro.sandbox') ? config('pagseguro.host.sandbox') : config('pagseguro.host.production');
    }

    public function get(String $access_token, String $path, array $query = null)
    {
        return Http::withHeaders(['x-api-version', self::api_version])->withToken($access_token)->get($this->url . $path, $query)->object();
    }

    public function post(string $access_token, string $path, $data)
    {
        return Http::withHeaders(['x-api-version', self::api_version])->withToken($access_token)->post($this->url . $path, $data)->object();
    }

    public function put(string $access_token, string $path, $data)
    {
        return Http::withHeaders(['x-api-version', self::api_version])->withToken($access_token)->put($this->url . $path, $data)->object();
    }

    public function delete(string $access_token, $path)
    {
        return Http::withHeaders(['x-api-version', self::api_version])->withToken($access_token)->delete($this->url . $path)->object();
    }

    public function upload(string $access_token, string $path, UploadedFile $file)
    {
        return Http::withToken($access_token)->attach(
            'file',
            file_get_contents($file),
            $file->getClientOriginalName()
        )->post($this->url . $path)->object();
    }

    public function download(string $access_token, string $path)
    {
        return Http::withToken($access_token)->withHeaders([
            'Content-Type' => 'text/plain',
        ])->get($this->url . $path)->body();
    }
}
