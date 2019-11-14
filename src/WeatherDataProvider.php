<?php
namespace Codium\CleanCode;

use Codium\CleanCode\Domain\CityId;

interface WeatherDataProvider {

    public function getCityId($city): CityId;
    public function getWeatherData(CityId $cityId);

}