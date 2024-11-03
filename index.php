<?php
// index.php
require 'vendor/autoload.php';

use App\Controllers\SiteController;
use App\Controllers\UserController;
use App\Controllers\DashboardController;
use App\Controllers\ProfileController;
use App\Controllers\SchoolPerformanceController;
use App\Controllers\WorkExperienceController; // Voeg de WorkExperienceController toe

$request = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$siteController = new SiteController();
$userController = new UserController();
$dashboardController = new DashboardController();
$profileController = new ProfileController();
$schoolPerformanceController = new SchoolPerformanceController();
$workExperienceController = new WorkExperienceController(); // Instantie van de WorkExperienceController

switch ($request) {
    case '/':
        $siteController->home();
        break;
    case '/login':
        if ($requestMethod === 'POST') {
            $userController->login(); // Login POST-verzoek
        } else {
            $userController->login(); // Login GET-verzoek
        }
        break;
    case '/about':
        $siteController->about();
        break;
    case '/contact':
        $siteController->contact();
        break;
    case '/register':
        $userController->register();
        break;
    case '/dashboard':
        $dashboardController->index();
        break;
    case '/profile':
        $profileController->index();
        break;
    case '/profile/edit':
        $profileController->edit();
        break;
    case '/schoolperformance/create':
        $schoolPerformanceController->create();
        break;
    case '/workexperience':
        $workExperienceController->index($_SESSION['user_id']); // Toon de lijst van werkervaringen
        break;
    case (preg_match('/^\/workexperience\/edit\/(\d+)$/', $request, $matches) ? true : false):
        $workExperienceController->edit($matches[1]); // Bewerk een specifieke werkervaring
        break;
    case '/workexperience/create':
        $workExperienceController->create(); // Maak een nieuwe werkervaring aan
        break;
    case (preg_match('/^\/workexperience\/delete\/(\d+)$/', $request, $matches) ? true : false):
        $workExperienceController->delete($matches[1]); // Verwijder een specifieke werkervaring
        break;

    // Check voor schoolprestatie bewerking
    case (preg_match('/^\/schoolperformance\/edit\/(\d+)$/', $request, $matches) ? true : false):
        $schoolPerformanceController->edit($matches[1]); // Bewerk een specifieke schoolprestatie
        break;

    default:
        $siteController->notFound(); // Toon een 404 pagina
        break;
}
