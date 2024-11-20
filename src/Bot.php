<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
class Bot{

    public $client;
    const API_URL = 'https://api.telegram.org/bot';
    private $token = '7662222216:AAGZb9JBcIA3CTGz7yJve5EuLLd3LrOL7Xk';

    public function makeRequest($method, $data = []){
        $this->client = new Client([
            'base_uri' => self::API_URL . $this->token,
            'timeout'  => 2.0,
            'verify' => false,
        ]);
        $request = $this->client->request('POST', '/' . $method, $data);
        $response = $request->getBody()->getContents();
        return $response;
    }
}