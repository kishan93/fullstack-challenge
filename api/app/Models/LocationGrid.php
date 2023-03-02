<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationGrid extends Model
{
    use HasFactory;

    protected $fillable = [
        'x',
        'y',
        'wfo',
        'weather_data',
    ];

    protected $casts = [
        'weather_data' => 'json',
        'x' => 'int',
        'y' => 'int',
    ];
}
