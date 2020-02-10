<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\Contracts\WeatherServiceInterface;

class WeatherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wind(WeatherServiceInterface $weather, Request $request, $zip)
    {
        return $weather->getWeather($zip);
    }
}
