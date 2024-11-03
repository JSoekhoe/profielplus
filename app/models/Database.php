<?php
namespace App\Models;

use PDO;

class Database {
    private $pdo;
    private $stmt; // Declareer deze eigenschap hier

    public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=localhost; dbname=profileplus',
            'root',
            'joeriesoekhoe');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query($query) {
        $this->stmt = $this->pdo->prepare($query); // Gebruik $this->stmt
    }

    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        return $this->stmt->execute(); // Verander $stmt in $this->stmt
    }

    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ); // Verander dit naar PDO::FETCH_OBJ om een object te retourneren
    }
}
