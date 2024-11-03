<?php

namespace App\Controllers;

use App\Models\WorkExperience;
use App\Models\Database;

class WorkExperienceController extends BaseController {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Zorg ervoor dat Database correct is geïnitialiseerd
    }

    public function index($userId) {
        // Verkrijg werkervaringen voor de gebruiker
        $workExperiences = WorkExperience::findByUserId($this->db, $userId);

        // Zorg ervoor dat het juiste pad naar de template wordt gebruikt
        $this->render('dashboard/work_experience/index', ['workExperiences' => $workExperiences]);
    }

    public function edit($id) {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: /login');
            exit;
        }

        // Haal werkervaring op om te bewerken
        $workExperience = WorkExperience::find($this->db, $id);
        if (!$workExperience) {
            echo "Work experience not found.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update werkervaring gegevens
            $workExperience->job_title = $_POST['job_title'] ?? '';
            $workExperience->company = $_POST['company'] ?? '';
            $workExperience->start_date = $_POST['start_date'] ?? '';
            $workExperience->end_date = $_POST['end_date'] ?? '';
            $workExperience->description = $_POST['description'] ?? '';

            if ($workExperience->update()) {
                header('Location: /dashboard');
                exit;
            } else {
                echo "Error occurred while updating work experience.";
            }
        }

        // Render de edit pagina met werkervaring gegevens
        $this->render('workexperience/edit', ['workExperience' => $workExperience]);
    }

    public function delete($id) {
        $workExperience = WorkExperience::find($this->db, $id);
        if ($workExperience) {
            $userId = $workExperience->user_id; // Verkrijg de user_id om eventueel door te verwijzen
            $workExperience->delete(); // Verwijder de werkervaring

            // Redirect naar dashboard
            header('Location: /dashboard');
        } else {
            echo "Work experience not found.";
        }
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nieuwe werkervaring aanmaken en gegevens instellen
            $workExperience = new WorkExperience($this->db);
            $workExperience->user_id = $userId; // Koppel aan de ingelogde gebruiker
            $workExperience->job_title = $_POST['job_title'] ?? '';
            $workExperience->company = $_POST['company'] ?? '';
            $workExperience->start_date = $_POST['start_date'] ?? '';
            $workExperience->end_date = $_POST['end_date'] ?? '';
            $workExperience->description = $_POST['description'] ?? '';

            // Sla op en redirect naar dashboard
            if ($workExperience->save()) {
                header('Location: /dashboard');
                exit;
            } else {
                echo "Error occurred while saving work experience.";
            }
        }

        // Render de create pagina
        $this->render('workexperience/create', ['userId' => $userId]);
    }
}
