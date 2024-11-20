<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


if  ($uri == '/weather') {
    require 'resources/Views/weather.php';
}
elseif ($uri == '/currency') {
    require 'src/Currency.php';
    $currency = new Currency();
    require 'resources/Views/currencyConverter.php';
}
elseif ($uri == '/telegram') {
    require 'app/bot.php';
}
else {
    echo 404;
}