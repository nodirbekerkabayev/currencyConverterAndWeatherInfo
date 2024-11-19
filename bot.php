<?php

require "src/Bot.php";
require "src/Currency.php";
require "src/Weather.php";

$bot = new Bot();
$currency = new Currency();
$weather = new Weather();

// Telegramdan kelayotgan xom JSON ma'lumotlarni yozish
$rawData = file_get_contents("php://input");
file_put_contents("log.txt", $rawData . PHP_EOL, FILE_APPEND);

// JSON ma'lumotlarni obyektga o'girish
$update = json_decode($rawData);

// JSON parse xatolarni tekshirish
if ($update === null) {
    file_put_contents("log.txt", "JSON decoding failed: " . json_last_error_msg() . PHP_EOL, FILE_APPEND);
    exit; // Kodni to'xtatish
}

// Ma'lumotlarning mavjudligini tekshirish
if (isset($update->message)) {
    $from_id = $update->message->chat->id ?? null;
    $text = $update->message->text ?? '';

    if ($from_id === null || $text === '') {
        file_put_contents("log.txt", "Invalid message structure: " . json_encode($update) . PHP_EOL, FILE_APPEND);
        exit; // Kodni to'xtatish
    }
} else {
    file_put_contents("log.txt", "No 'message' object found in update: " . json_encode($update) . PHP_EOL, FILE_APPEND);
    exit; // Kodni to'xtatish
}

// Buyruqlarni qayta ishlash
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
