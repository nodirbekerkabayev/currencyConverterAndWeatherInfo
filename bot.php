<?php
require "src/Bot.php";
require "src/Currency.php";

$bot = new Bot();
$currency = new Currency();

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