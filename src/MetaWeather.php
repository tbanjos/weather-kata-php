<?php

namespace Codium\CleanCode;

use GuzzleHttp\Client;

class MetaWeather implements WeatherApiClientInterface {

    const BASE_URL = 'https://www.metaweather.com/api/';
    private $httpClient;

    public function __construct()
    {
        // Create a Guzzle Http Client
        $this->httpClient = new Client();
    }

    private function get($url)
    {
        echo "url: $url\n";

        $responseJson = $this->httpClient->get(self::BASE_URL . $url)
            ->getBody()
            ->getContents();
        $responseArray = json_decode($responseJson, JSON_OBJECT_AS_ARRAY);

        return $responseArray;
    }

    public function getCity($city)
    {
        return $this->get("location/search/?query=$city")[0]['woeid'];
    }

    public function getWeatherData($woeid)
    {
        return $this->get("location/$woeid")['consolidated_weather'];
    }

}