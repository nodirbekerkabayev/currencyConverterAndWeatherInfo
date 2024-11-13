<?php

require 'Currency.php';

$currency = new Currency();
$currencies = $currency->getCurrencies();
$currency->calculateCurrencys($_GET['amount'], $_GET['from']);

require 'Views/currencyConverter.php';