<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

const CURRENCY_API_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";

class Currency
{
    public $client;
    public array $currencies = [];
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => CURRENCY_API_URL,
            'timeout'  => 2.0,
            'verify' => false
        ]);
        $request = $this->client->request('GET', '');
        $this->currencies = json_decode($request->getBody()->getContents());
        return $this->currencies;

    }

    public function getCurrencies()
    {
        $seperateData = [];
        $currinciesInfo = $this->currencies;
        foreach ($currinciesInfo as $currency) {
            $seperateData[$currency->Ccy] = $currency->Rate;
        }
        return $seperateData;
    }
}