<?php
require_once '../../config/database.php';

class SchoolPerformanceMigration
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS school_performance (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) UNSIGNED NOT NULL,
            institution VARCHAR(100) NOT NULL,
            degree VARCHAR(100),
            field_of_study VARCHAR(100),
            start_date DATE,
            end_date DATE,
            grade DECIMAL(4, 2),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            INDEX idx_user_id (user_id)  -- Voeg index toe voor betere prestaties
        ) ENGINE=InnoDB;";

        try {
            $this->db->exec($sql);
            echo "Table 'school_performance' created successfully.\n";
        } catch (PDOException $e) {
            echo "Error creating table 'school_performance': " . $e->getMessage() . "\n";
        }
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS school_performance;";

        try {
            $this->db->exec($sql);
            echo "Table 'school_performance' dropped successfully.\n";
        } catch (PDOException $e) {
            echo "Error dropping table 'school_performance': " . $e->getMessage() . "\n";
        }
    }
}

// Gebruik de migratie
$database = new Database();
$pdo = $database->getConnection();
$migration = new SchoolPerformanceMigration($pdo);
$migration->up();
// $migration->down(); // Gebruik dit om de tabel te verwijderen
?>
