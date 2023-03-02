<?php

namespace App\Lib\WeatherApi\Resources;

class Forecast extends Resource
{
    public function hourly($wfo, $x, $y)
    {
        return $this->apiClient->get("/gridpoints/{$wfo}/{$x},{$y}/forecast/hourly");
    }

}
