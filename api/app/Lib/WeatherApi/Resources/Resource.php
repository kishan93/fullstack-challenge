<?php

namespace App\Lib\WeatherApi\Resources;

use App\Lib\WeatherApi\WeatherApiClient;

abstract class Resource
{

    protected WeatherApiClient $apiClient;

    public function __construct(WeatherApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }
}
