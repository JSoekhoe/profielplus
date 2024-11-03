<?php
require_once '../../config/database.php';

class UsersMigration
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db; // Ontvang de PDO-verbinding vanuit de Database klasse
    }

    public function up()
    {
        // SQL voor het aanmaken van de 'users' tabel
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(50) NOT NULL,
            lastname VARCHAR(50) NOT NULL,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;";

        try {
            $this->db->exec($sql);
            echo "Table 'users' created successfully.\n";
        } catch (PDOException $e) {
            echo "Error creating table 'users': " . $e->getMessage() . "\n";
        }
    }

    public function down()
    {
        // SQL voor het verwijderen van de 'users' tabel
        $sql = "DROP TABLE IF EXISTS users;";

        try {
            $this->db->exec($sql);
            echo "Table 'users' dropped successfully.\n";
        } catch (PDOException $e) {
            echo "Error dropping table 'users': " . $e->getMessage() . "\n";
        }
    }
}

// Voorbeeld van het gebruik van de migratiebestand
$database = new Database(); // Maak een nieuwe instantie van de Database klasse
$pdo = $database->getConnection(); // Haal de PDO-verbinding op

// Maak een nieuwe instantie van UsersMigration en voer de migratie uit
$migration = new UsersMigration($pdo);
$migration->up(); // Voer de 'up' methode uit om de tabel aan te maken

// Indien je de tabel wilt verwijderen, roep je de down methode aan
// $migration->down();
?>
