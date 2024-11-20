<?php

class DB{
    public $pdo;
    public function __construct(){
        $dsn = "mysql:host=localhost;dbname=telegramBot";
        $this->pdo = new PDO($dsn, "root", "root");
    }
}