<?php

const CURRENCY_API_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";

class Currency
{
    public array $currencies = [];

    public function __construct()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, CURRENCY_API_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        $this->currencies = json_decode($output);

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

    public function exchange($value, $currencyName = 'USD')
    {
        // echo ceil($value / $this->getCurrencies()[$currencyName]) . ' ' . $currencyName;
    }

    public function calculateCurrencys($value, $currencyName){
        echo $value ." ". $currencyName ." = ". $value * $this->getCurrencies()[$currencyName] ." USZ";
    }

}

$currency = new Currency();

$currency->exchange(12800);