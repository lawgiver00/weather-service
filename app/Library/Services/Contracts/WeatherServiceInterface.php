<?php

namespace App\Library\Services\Contracts;

Interface WeatherServiceInterface
{
    public function getWeather($zip);
}