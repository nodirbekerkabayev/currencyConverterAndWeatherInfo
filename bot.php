<?php

require "src/Bot.php";
require "src/Currency.php";
require "src/Weather.php";

$bot = new Bot();
$currency = new Currency();
$weather = new Weather();

$update = json_decode(file_get_contents("php://input"));

$from_id = $update->message->chat->id;
$text = $update->message->text;


if ($text == '/start') {
    $bot->makeRequest('sendMessage', [
        'chat_id' => $from_id,
        'text' => 'Xush kelibsiz! Ushbu bot orqali valyuta kurslarini bilib olishingiz mumkin.'
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
        'text' => "Temperature: " . round($temperature, 2) . " °C\n" .
            "Pressure: " . $pressure . " hPa\n" .
            "Humidity: " . $humidity . "%\n"
    ]);
}