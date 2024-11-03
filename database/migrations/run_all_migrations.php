<?php

require_once '../../config/database.php';

// Lijst met migratiebestanden
$migrations = [
    '../migrations/users_migration.php',
    '../migrations/profile_migration.php',
    '../migrations/workexperience_migration.php',
    '../migrations/schoolperformance_migration.php',
    '../migrations/hobbies_migration.php',
];

// Maak een nieuwe instantie van de Database klasse
$database = new Database();
$pdo = $database->getConnection(); // Haal de PDO-verbinding op

foreach ($migrations as $migrationFile) {
    require_once $migrationFile; // Importeer elk migratiebestand

    // Dynamisch de migratieklasse ophalen
    $className = basename($migrationFile, '.php');
    if (class_exists($className)) {
        $migration = new $className($pdo);
        $migration->up(); // Voer de 'up' methode uit om de tabel aan te maken
        echo "Migratie voor $className uitgevoerd!<br>";
    }
}

