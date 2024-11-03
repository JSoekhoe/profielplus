<?php
namespace App\Controllers;

class BaseController
{
    public function __construct() {
        // Zorg dat sessie gestart wordt indien nog niet gestart
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function render($view, $data = [])
    {
        extract($data);  // Haalt de data uit het array en maakt variabelen beschikbaar
        ob_start();  // Start output buffering
        require __DIR__ . '/../views/' . $view . '.php';  // Laadt de view
        $content = ob_get_clean();  // Haalt de inhoud van de buffer op en slaat het op in $content
        require __DIR__ . '/../views/layouts/app.php';  // Laadt de layout met de content
    }
}
