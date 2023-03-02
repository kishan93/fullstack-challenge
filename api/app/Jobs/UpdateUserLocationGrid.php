<?php

namespace App\Jobs;

use App\Lib\WeatherApi\WeatherApiClient;
use App\Models\LocationGrid;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateUserLocationGrid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(): void
    {
        // make api request to find grid data
        try {
            $point = WeatherApiClient::make('points')
                ->get($this->user->latitude, $this->user->longitude);

            if (!array_key_exists('properties', $point)) {
                Log::info('location grid data not found on API');
                Log::debug($point);
                return;
            }

            $data = [
                'x' => $point['properties']['gridX'],
                'y' => $point['properties']['gridX'],
                'wfo' => $point['properties']['gridId'],
            ];

            $locationGrid = LocationGrid::where('x', $data['x'])->where('y', $data['y'])->first();

            if (!$locationGrid) {
                $locationGrid = LocationGrid::create($data);
            }

            // assign location grid id to user
            $this->user->location_grid_id = $locationGrid->id;
            $this->user->save();
        } catch (\Exception $exception){
            Log::info($point ?? $exception);
            throw $exception;
        }
    }
}
