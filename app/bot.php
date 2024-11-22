<?php

require "src/Bot.php";
require "src/Currency.php";
require "src/Weather.php";

$bot = new Bot();
$currency = new Currency();
$weather = new Weather();

$update = json_decode(file_get_contents("php://input"));

if(isset($update)){
    $from_id = $update->message->chat->id;
    $text = $update->message->text;
    $username = $update->message->from->username;


    if ($text == '/start') {
        $bot->saveUsers($from_id, $username);
        $reply_keyboard = [
            'keyboard' => [
                [
                    ['text' => 'Ob havo'],
                    ['text' => 'Valyuta'],
                ]
            ],
            'resize_keyboard' => true,
        ];

        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => 'Xush kelibsiz! Ushbu bot orqali valyuta kurslarini bilib olishingiz mumkin.',
        ]);
    }

    if ($text == '/currency') {
        $currencies = $currency->getCurrencies();
        $currency_list = '';

        foreach ($currencies as $currency_code => $rate) {
            $currency_list .= "1 " . $currency_code . " = " . $rate . " UZS\n";
        }

        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => $currency_list
        ]);
    }
    if ($text == '/weather') {
        $weatherInfo = $weather->getWeather();
        $temperature = $weatherInfo->main->temp - 273.15;
        $pressure = $weatherInfo->main->pressure;
        $humidity = $weatherInfo->main->humidity;

        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => "Weather in Tashkent\n\nTemperature: " . round($temperature, 2) . " °C\n\n" .
                "Pressure: " . $pressure . " hPa\n\n" .
                "Humidity: " . $humidity . "%\n\n"
        ]);
    }
    if ($text == 'Ob havo') {
        $weatherInfo = $weather->getWeather();

        $temperature = $weatherInfo->main->temp - 273.15;
        $pressure = $weatherInfo->main->pressure;
        $humidity = $weatherInfo->main->humidity;

        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => "Weather in Tashkent\n\nTemperature: " . round($temperature, 2) . " °C\n\n" .
                "Pressure: " . $pressure . " hPa\n\n" .
                "Humidity: " . $humidity . "%\n\n"
        ]);
    }
    if ($text == 'Valyuta') {
        $currencies = $currency->getCurrencies();
        $currency_list = '';

        foreach ($currencies as $currency_code => $rate) {
            $currency_list .= "1 " . $currency_code . " = " . $rate . " UZS\n";
        }

        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => $currency_list
        ]);
    }
}