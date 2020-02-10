<?php

namespace App\Library\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

class OpenWeatherMap
{
    public static function getWeather($zip)
    {
        $client = new \GuzzleHttp\Client();
        //I signed up for this at the end of creating this project and it looks like I have to wait for them to validate my account. I'm including sample data until they approve it
        try{
            $response = $client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?zip='.$zip.',us&appid=b6907d289e10d714a6e88b30761fae22');
            return($response->getBody());
        }catch(ClientException $e){
                return '{"coord": {"lon": -122.08,"lat": 37.39},"weather": [{"id": 800,"main": "Clear","description": "clear sky","icon": "01d"}],"base": "stations","main": {"temp": 282.55,"feels_like": 281.86,"temp_min": 280.37,"temp_max": 284.26,"pressure": 1023,"humidity": 100},"visibility": 16093,"wind": {"speed": 1.5,"deg": 350},"clouds": {"all": 1},"dt": 1560350645,"sys": {"type": 1,"id": 5122,"message": 0.0139,"country": "US","sunrise": 1560343627,"sunset": 1560396563},"timezone": -25200,"id": 420006353,"name": "Mountain View","cod": 200}';
        }
    }
}