<?php
require_once '../../config/database.php';

class WorkExperienceMigration
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS work_experience (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) UNSIGNED NOT NULL,
            job_title VARCHAR(100) NOT NULL,
            company VARCHAR(100) NOT NULL,
            description TEXT,
            start_date DATE NOT NULL,
            end_date DATE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;";

        try {
            $this->db->exec($sql);
            echo "Table 'work_experience' created successfully.\n";
        } catch (PDOException $e) {
            echo "Error creating table 'work_experience': " . $e->getMessage() . "\n";
        }
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS work_experience;";

        try {
            $this->db->exec($sql);
            echo "Table 'work_experience' dropped successfully.\n";
        } catch (PDOException $e) {
            echo "Error dropping table 'work_experience': " . $e->getMessage() . "\n";
        }
    }
}

// Gebruik de migratie
$database = new Database();
$pdo = $database->getConnection();
$migration = new WorkExperienceMigration($pdo);
$migration->up();
// $migration->down(); // Gebruik dit om de tabel te verwijderen
?>
