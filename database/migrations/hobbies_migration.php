<?php
require_once '../../config/database.php';

class HobbiesMigration
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS hobbies (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) UNSIGNED NOT NULL,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            image_url VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;";

        try {
            $this->db->exec($sql);
            echo "Table 'hobbies' created successfully.\n";
        } catch (PDOException $e) {
            echo "Error creating table 'hobbies': " . $e->getMessage() . "\n";
        }
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS hobbies;";

        try {
            $this->db->exec($sql);
            echo "Table 'hobbies' dropped successfully.\n";
        } catch (PDOException $e) {
            echo "Error dropping table 'hobbies': " . $e->getMessage() . "\n";
        }
    }
}

// Gebruik de migratie
$database = new Database();
$pdo = $database->getConnection();
$migration = new HobbiesMigration($pdo);
$migration->up();
// $migration->down(); // Gebruik dit om de tabel te verwijderen
?>
