<?php

require __DIR__ . '/../vendor/autoload.php';
require "src/DB.php";

use GuzzleHttp\Client;

class Bot {
    public $pdo;
    public $client;
    const API_URL = 'https://api.telegram.org/bot';
    private $token = '7662222216:AAGZb9JBcIA3CTGz7yJve5EuLLd3LrOL7Xk';
    public function __construct() {
        $this->client = new Client([
            'base_uri' => self::API_URL . $this->token . '/',  // To'g'ri URL formatida
            'timeout'  => 5.0,  // 5 soniya kutish
            'verify' => true,    // Sertifikatni tekshirish
        ]);
    }
    public function makeRequest($method, $data = []) {
        $response = $this->client->request('POST', '/' . $method, [
            'json' => $data  // JSON formatda yuborish
        ]);

        return json_decode($response->getBody()->getContents(), true);  // JSONni arrayga aylantirib qaytarish
    }
    public function saveUsers($chat) {

        if (isset($chat['id'])){

            $userId = $chat['id'];
            $username = $chat['username'] ?? 'Unknown';


            $db = new DB();
            $this->pdo = $db->pdo;

            $stmt = $this->pdo->prepare("INSERT INTO telegrambot(username, userId) VALUES (:userName, :userId)");
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            return "Foydalanuvchi ma'lumotlari saqlandi: $userId\n" . "$username";
        } else {
            return "Javobda 'chat' ma'lumoti topilmadi.\n";
        }
    }

}