<?php

class Bot{
    const API_URL = 'https://api.telegram.org/bot';
    private $token = '7662222216:AAGZb9JBcIA3CTGz7yJve5EuLLd3LrOL7Xk';

    public function makeRequest($method, $data = []){
        $ch = curl_init(self::API_URL . $method);
        curl_setopt($ch, CURLOPT_URL, self::API_URL . $this->token . '/' . $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }
}