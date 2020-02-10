<?php

namespace App\Library\Services;

use App\Library\Services\Contracts\WeatherServiceInterface;
use App\Library\Services\OpenWeatherMap;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class Weather implements WeatherServiceInterface
{
    private $serializer;


    public function __construct()
    {

    }

    public function getWeather($zip)
    {
        if(!preg_match("/^[0-9]{5}$/", $zip)){
            return response()->json(['message' => "Incorrect zip code format"])->setStatusCode(400);
        } else {
            if(Cache::get("weather".$zip)){
                return $this->formatWeather(Cache::get("weather".$zip));
            } else {
                return $this->getNewWeather($zip);
            }
        }
    }

    private function getNewWeather($zip){

        if($weather = OpenWeatherMap::getWeather($zip)){
            Cache::put('weather'.$zip, $weather, 15);
            return $this->formatWeather($weather);
        } else {
            return response()->json(['message' => "An error occurred with your request"])->setStatusCode(400);
        }
    }

    private function formatWeather($weather){
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $weather_array = $serializer->decode($weather,'json');
        return response()->json(["wind_speed"=>$weather_array["wind"]["speed"],"wind_direction"=>$weather_array["wind"]["deg"]])->setStatusCode(200);
    }
}