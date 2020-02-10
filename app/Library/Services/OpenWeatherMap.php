<?php

namespace App\Library\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

class OpenWeatherMap
{
    public static function getWeather($zip)
    {
        try{
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'http://api.openweathermap.org/data/2.5/weather?zip='.$zip.'&appid=acf384f457dc20241492b13dac21c8a9');
            return($response->getBody());
        } catch(ClientException $e){
            return false;
        }

    }
}