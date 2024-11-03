<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'profileplus';
    private $username = 'root';
    private $password = 'joeriesoekhoe';
    private $pdo;
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    // Constructor om direct verbinding te maken bij het aanmaken van een instantie
    public function __construct()
    {
        $this->connect();
    }

    // Verbinding maken met de database
    private function connect()
    {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8mb4';
            $this->pdo = new PDO($dsn, $this->username, $this->password, $this->options);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Methode om de PDO verbinding terug te geven
    public function getConnection()
    {
        return $this->pdo;
    }
}

