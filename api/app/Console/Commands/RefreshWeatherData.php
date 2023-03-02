<?php

namespace App\Console\Commands;

use App\Lib\WeatherApi\WeatherApiClient;
use App\Models\LocationGrid;
use Illuminate\Console\Command;

class RefreshWeatherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:data:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh weather data for location grids';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $locationGrids = LocationGrid::query()->orderBy('updated_at')->limit(10)->get();
        $locationGrids->map(function ($locationGrid) {
            $response = WeatherApiClient::make('forecast')->hourly(wfo: $locationGrid->wfo, x: $locationGrid->x, y: $locationGrid->y);
            $locationGrid->updated_at = now();
            if (!array_key_exists('properties', $response)) {
                $this->warn(json_encode($response));
                $locationGrid->save();
                return;
            }

            $data = $response['properties'];
            $data['info'] = $data['periods'][0];
            unset($data['periods']);
            $locationGrid->weather_data = $data;
            $locationGrid->save();
            $this->info('updated data for '. $locationGrid->id);
        });
    }
}
