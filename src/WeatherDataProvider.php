<?php
namespace Codium\CleanCode;

interface WeatherApiClientInterface {

    public function getCity($city);
    public function getWeatherData($woeid);

}