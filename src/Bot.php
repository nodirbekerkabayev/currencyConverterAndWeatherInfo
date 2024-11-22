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
            'base_uri' => self::API_URL . $this->token . '/',
            'timeout'  => 5.0,
            'verify' => false,
        ]);
    }
    public function makeRequest($method, $data = []) {
        $response = $this->client->request('POST', $method, [
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
    public function saveUsers($userId, $username){
        if ($this->getUsers($userId)){
            return false;
        }
        $query = "INSERT INTO telegrambot(username, userId) VALUES (:userId, :username)";
        $db = new DB();
        return $db->pdo->prepare($query)->execute([
            ':userId' => $userId,
            ':username' => $username
        ]);
        }
    public function getUsers($userId){
        $query = "SELECT * FROM telegrambot WHERE userId = :userId";
        $db = new DB();
        $stmt = $db->pdo->prepare($query);
        $stmt->execute([
            ':userId' => $userId
        ]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}