<?php
require_once '../../config/database.php';

class ProfileMigration
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS profile (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) UNSIGNED NOT NULL,
            bio TEXT,
            birth_date DATE,
            phone VARCHAR(20),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;";

        try {
            $this->db->exec($sql);
            echo "Table 'profile' created successfully.\n";
        } catch (PDOException $e) {
            echo "Error creating table 'profile': " . $e->getMessage() . "\n";
        }
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS profile;";

        try {
            $this->db->exec($sql);
            echo "Table 'profile' dropped successfully.\n";
        } catch (PDOException $e) {
            echo "Error dropping table 'profile': " . $e->getMessage() . "\n";
        }
    }
}

// Gebruik de migratie
$database = new Database();
$pdo = $database->getConnection();
$migration = new ProfileMigration($pdo);
$migration->up();
// $migration->down(); // Gebruik dit om de tabel te verwijderen
?>
