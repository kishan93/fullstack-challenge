<?php

namespace App\Lib\WeatherApi;

use App\Lib\WeatherApi\Resources\Forecast;
use App\Lib\WeatherApi\Resources\Points;
use App\Lib\WeatherApi\Resources\Resource;
use Illuminate\Support\Facades\Http;

class WeatherApiClient
{
    protected string $baseUrl;
    protected \Illuminate\Http\Client\PendingRequest $http;
    protected \Illuminate\Http\Client\Response|\GuzzleHttp\Promise\PromiseInterface $response;

    public function __construct(?string $baseUrl = null)
    {
        $this->baseUrl = $baseUrl ?? "https://api.weather.gov";
        $this->http = Http::baseUrl($this->baseUrl);

        //TODO: make value for user agent dynamic
        $this->http->withUserAgent('(myweatherapp.com, contact@myweatherapp.com)');
    }

    public function get(string $endpoint, ?array $params = null)
    {
        $this->response = $this->http->get($endpoint, $params);
        return $this->response->json();
    }

    public function post(string $endpoint, array $data)
    {
        $this->response = $this->http->post($endpoint, $data);
        return $this->response->json();
    }

    public function resource($resource): ?Resource
    {
        return match ($resource) {
            'points' => new Points($this),
            'forecast' => new Forecast($this),
            default => null,
        };
    }

    public static function make($resource): Resource
    {
        return (new static)->resource($resource);
    }

}
