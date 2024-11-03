<?php

namespace App\Controllers;

use App\Models\SchoolPerformance;
use App\Models\Database;
use App\Models\User;

class SchoolPerformanceController extends BaseController
{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Lijst van schoolprestaties
    public function index($userId) {
        // Haal schoolprestaties op voor de ingelogde gebruiker
        $schoolPerformances = SchoolPerformance::findByUserId($this->db, $userId);
        $this->render('dashboard/index', ['schoolPerformances' => $schoolPerformances]);
    }

    // Schoolprestatie bewerken
    public function edit($id) {
        // Controleer of de gebruiker is ingelogd
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $user = User::find($userId);
        if (!$user) {
            echo "User not found.";
            exit;
        }

        // Zoek de schoolprestatie op basis van ID
        $schoolPerformance = SchoolPerformance::find($this->db, $id);
        if (!$schoolPerformance) {
            echo "School performance not found.";
            exit;
        }

        // Controleren of het formulier is ingediend
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verzamel gegevens van het POST-verzoek
            $schoolPerformance->institution = $_POST['institution'] ?? '';
            $schoolPerformance->degree = $_POST['degree'] ?? '';
            $schoolPerformance->field_of_study = $_POST['field_of_study'] ?? '';
            $schoolPerformance->start_date = $_POST['start_date'] ?? '';
            $schoolPerformance->end_date = $_POST['end_date'] ?? '';
            $schoolPerformance->grade = $_POST['grade'] ?? '';

            // Update schoolprestatie
            if ($schoolPerformance->update()) {
                header('Location: /dashboard');
                exit;
            } else {
                echo "Error occurred while updating the school performance.";
            }
        }

        // Render de bewerkpagina met de huidige gegevens
        $this->render('schoolperformance/edit', ['user' => $user, 'performance' => $schoolPerformance]);
    }

    // Schoolprestatie verwijderen
    public function delete($id) {
        // Zoek de schoolprestatie op basis van ID
        $schoolPerformance = SchoolPerformance::find($this->db, $id);
        if ($schoolPerformance) {
            $userId = $schoolPerformance->user_id; // Verkrijg de user_id
            $schoolPerformance->delete(); // Verwijder de schoolprestatie
            header('Location: /dashboard/index/' . $userId); // Redirect naar de dashboard
        } else {
            echo "Schoolprestatie niet gevonden.";
        }
    }

    // Nieuwe schoolprestatie toevoegen
    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $user = User::find($userId);
        if (!$user) {
            echo "User not found.";
            exit;
        }

        // Controleer of het formulier is ingediend
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $performance = new SchoolPerformance($this->db); // Pass the database instance
            $performance->user_id = $userId; // Koppel aan de ingelogde gebruiker

            // Verzamel gegevens van het POST-verzoek
            $performance->institution = $_POST['institution'] ?? '';
            $performance->degree = $_POST['degree'] ?? '';
            $performance->field_of_study = $_POST['field_of_study'] ?? '';
            $performance->start_date = $_POST['start_date'] ?? '';
            $performance->end_date = $_POST['end_date'] ?? '';
            $performance->grade = $_POST['grade'] ?? '';

            if ($performance->save()) {
                header('Location: /dashboard' . $userId);
                exit;
            } else {
                echo "Error occurred while saving the school performance.";
            }
        }

        // Render de create pagina
        $this->render('schoolperformance/create', ['user' => $user]);
    }
}
