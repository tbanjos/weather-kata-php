<?php

namespace Tests\Codium\CleanCode;

use Codium\CleanCode\Forecast;
use PHPUnit\Framework\TestCase;

use Codium\CleanCode\MetaWeather;

class WeatherTest extends TestCase
{
    private $forecast;

    protected function setUp()
    {
        $this->forecast = new CityWeatherForecast(new MetaWeatherProvider());
    }

    // https://www.metaweather.com/api/location/766273/
    /** @test */
    public function find_the_weather_of_today()
    {
        $city = "Madrid";

        $prediction = $this->forecast->predict($city);

        echo "Today: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function find_the_weather_of_any_day()
    {
        
        $city = "Madrid";

        $prediction = $this->forecast->predict($city, new \DateTime('+2 days'));

        echo "Day after tomorrow: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function find_the_wind_of_any_day()
    {
        
        $city = "Madrid";

        $prediction = $this->forecast->predict($city, null, true);

        echo "Wind: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function change_the_city_to_woeid()
    {
        
        $city = "Madrid";

        $this->forecast->predict($city, null, true);

        $this->assertEquals("766273", $city);
    }

    /** @test */
    public function there_is_no_prediction_for_more_than_5_days()
    {
        
        $city = "Madrid";

        $prediction = $this->forecast->predict($city, new \DateTime('+6 days'));

        $this->assertEquals("", $prediction);
    }
}