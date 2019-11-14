<?php

namespace Codium\CleanCode;

use Codium\CleanCode\Domain\CityId;
use GuzzleHttp\Client;

class MetaWeatherProvider implements WeatherDataProvider {

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

    public function getCityId($city): CityId
    {
        $woeid = $this->get("location/search/?query=$city")[0]['woeid'];
        return new CityId($woeid);
    }

    public function getWeatherData(CityId $cityId)
    {
        return $this->get("location/".$cityId->value())['consolidated_weather'];
    }
}