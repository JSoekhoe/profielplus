<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usernameOrEmail = trim($_POST['username_or_email']);
            $password = trim($_POST['password']);

            $user = filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) ?
                $this->userModel->getUserByEmail($usernameOrEmail) :
                $this->userModel->getUserByUsername($usernameOrEmail);

            $this->authenticate($user, $password);
        } else {
            $this->render('users/login');
        }
    }

    private function authenticate($user, $password) {
        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            header('Location: /dashboard');
            exit;
        }

        $error = "Onjuiste inloggegevens.";
        $this->render('users/login', ['error' => $error]);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
            ];

            // Valideer de invoer
            $errors = $this->validateRegistration($data);
            if (empty($errors)) {
                // Registreer de gebruiker
                if ($this->userModel->createUser($data)) {
                    header('Location: /login');
                    exit;
                } else {
                    $errors[] = "Er is een fout opgetreden bij het registreren van de gebruiker.";
                }
            }

            // Render het registratieformulier met fouten
            $this->render('users/register', ['errors' => $errors, 'data' => $data]);
        } else {
            $this->render('users/register');
        }
    }

    private function validateRegistration($data)
    {
        $errors = [];
        if (empty($data['firstname'])) {
            $errors[] = "Voornaam is verplicht.";
        }
        if (empty($data['lastname'])) {
            $errors[] = "Achternaam is verplicht.";
        }
        if (empty($data['username'])) {
            $errors[] = "Gebruikersnaam is verplicht.";
        }
        if (empty($data['email'])) {
            $errors[] = "E-mail is verplicht.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Ongeldig e-mailadres.";
        }
        if (empty($data['password'])) {
            $errors[] = "Wachtwoord is verplicht.";
        } elseif ($data['password'] !== $data['confirm_password']) {
            $errors[] = "Wachtwoorden komen niet overeen.";
        }

        return $errors;
    }
}
