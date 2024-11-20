<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
class Weather {

    public $client;
    const WEATHER_API_URL = 'https://api.openweathermap.org/data/2.5/weather?q=Tashkent&appid=1f2c4527291b18aaab758440a1f8e071';
    public $weather_data = [];
    public function __construct () {
        $this->client = new Client([
            'base_uri' => self::WEATHER_API_URL,
            'timeout'  => 2.0,
            'verify' => false,
        ]);
        $request = $this->client->request('GET');
        return $request;

    }
    public function getWeather () {
        return $this->weather_data;
    }
}