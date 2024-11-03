<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class SiteController extends BaseController
{
    public function home()
    {
        $this->render('users/login'); // Gebruik render om de base layout te laden
    }

    public function login()
    {
        $this->render('users/login'); // Gebruik render om de base layout te laden
    }

    public function about()
    {
        $this->render('about'); // Gebruik render om de base layout te laden
    }

    public function contact()
    {
        $this->render('contact'); // Gebruik render om de base layout te laden
    }

    public function register()
    {
        $this->render('users/register'); // Gebruik render om de base layout te laden
    }

    public function notFound()
    {
        http_response_code(404);
        echo '<h1>404 - Niet Gevonden</h1>';
        echo '<p>De pagina die u zoekt bestaat niet.</p>';
    }
}
