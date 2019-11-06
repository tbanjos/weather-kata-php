<?php

namespace Codium\CleanCode;

use GuzzleHttp\Client;
use Codium\CleanCode\WeatherApiClientInterface;


class Forecast
{
    const MAX_DATE_PREDICTIONS = "+6 days 00:00:00";
    const VALID_DATE_FORMAT = 'Y-m-d';
    const EMPTY_STRING = "";
    
    /** @var WeatherApiClientInterface $apiClient */
    private $apiClient;

    function __construct(WeatherApiClientInterface $apiClient){
        $this->apiClient = $apiClient;
    }

    public function predict(string &$city, \DateTime $datetime = null, bool $wind = false): string
    {
        // When date is not provided we look for the current prediction
        if (!$datetime) {
            $datetime = new \DateTime();
        }

        // If there are no predictions
        if ($datetime >= new \DateTime(self::MAX_DATE_PREDICTIONS)) {
            return self::EMPTY_STRING;               
        }

        // Find the id of the city on metawheather
        $city = $this->apiClient->getCity($city);

        // Find the predictions for the city
        $results = $this->apiClient->getWeatherData($city);


        foreach ($results as $result) {

            // When the date is not the expected
            if (! $result["applicable_date"] == $datetime->format(self::VALID_DATE_FORMAT)) {
                break;
            }

            if ($wind) {
                return $result['wind_speed'];
            } 

            return $result['weather_state_name'];
        }
    }
}