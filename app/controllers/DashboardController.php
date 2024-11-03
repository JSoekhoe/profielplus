<?php
namespace App\Controllers;

use App\Models\Database;
use App\Models\User;
use App\Models\Profile;
use App\Models\SchoolPerformance;
use App\Models\WorkExperience;
use App\Models\Hobby;

class DashboardController extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        // Get the logged-in user
        $userId = $_SESSION['user_id'];
        $user = User::find($userId, $this->db);

        if (!$user) {
            echo "User not found.";
            exit;
        }

        // Get the profile using user_id
        $profile = Profile::findByUserId($userId, $this->db);

        // Get school performances using user_id
        $schoolperformance = SchoolPerformance::findByUserId($this->db, $userId); // Corrected parameter order

        // Get work experience using user_id
        $workexperience = WorkExperience::findByUserId($this->db, $userId);

        // Get hobbies using user_id
        $hobbies = Hobby::findByUserId($userId, $this->db);

        // Pass data to the view
        $data = [
            'username' => htmlspecialchars($user->username),
            'user' => $user,
            'profile' => $profile,
            'schoolperformance' => $schoolperformance,
            'workexperience' => $workexperience,
            'hobbies' => $hobbies,
        ];

        $this->render('dashboard/index', $data);
    }
}

