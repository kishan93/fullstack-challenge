<?php

namespace App\Lib\WeatherApi\Resources;

use App\Lib\WeatherApi\WeatherApiClient;

class Points extends Resource
{

    public function get(float $latitude, float $longitude)
    {
        return $this->apiClient->get("/points/{$latitude},$longitude");
    }
}
