<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Profile;

class ProfileController extends BaseController
{
    public function edit()
    {
        // Controleer of de gebruiker is ingelogd
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $user = User::find($userId);

        if (!$user) {
            echo "Gebruiker niet gevonden.";
            exit;
        }

        // Haal profielgegevens op
        $profile = Profile::findByUserId($userId);

        // Controleer of het formulier is verzonden
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Haal invoergegevens op uit POST-verzoek
            $user->firstname = $_POST['firstname'] ?? $user->firstname;
            $user->lastname = $_POST['lastname'] ?? $user->lastname;
            $user->username = $_POST['username'] ?? $user->username;
            $user->email = $_POST['email'] ?? $user->email;

            // Update de gebruiker
            if ($user->updateUserProfile()) {
                // Bijwerken of aanmaken van het profiel
                if ($profile) {
                    // Bijwerken van bestaande profielgegevens
                    $profile->bio = $_POST['bio'] ?? null; // Laat het leeg als er geen bio is
                    $profile->phone = $_POST['phone'] ?? null; // Laat het leeg als er geen telefoon is
                    $profile->update(); // Zorg ervoor dat je een update functie hebt in het Profile model
                } else {
                    // Maak een nieuw profiel aan
                    Profile::create($userId, $_POST['bio'] ?? null, $_POST['phone'] ?? null);
                }

                header('Location: /dashboard');
                exit;
            } else {
                echo "Er is een fout opgetreden bij het bijwerken van het profiel.";
            }
        }

        // Render de edit view met de huidige gegevens
        $this->render('profile/edit', ['user' => $user, 'profile' => $profile]);
    }
}
