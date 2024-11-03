<?php

namespace App\Models;

class User {
    private $db;

    // Attributen voor de User klasse
    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $bio;

    public function __construct() {
        $this->db = new Database(); // Zorg ervoor dat je Database klasse correct is geïmplementeerd
    }

    // Zoek een gebruiker op basis van ID en retourneer een User object
    public static function find($id) {
        $db = new Database(); // Maak een nieuw Database object
        $db->query('SELECT * FROM users WHERE id = :id');
        $db->bind(':id', $id);
        $data = $db->single(); // Retourneert een object

        // Als er geen data is, retourneer null
        if (!$data) {
            return null;
        }

        // Maak een nieuw User object en vul het met gegevens
        $user = new self();
        $user->id = $data->id;
        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname;
        $user->username = $data->username;
        $user->email = $data->email;

        return $user;
    }

    // Creëer een nieuwe gebruiker
    public function createUser($data) {
        $this->db->query('INSERT INTO users (firstname, lastname, username, email, password) VALUES (:firstname, :lastname, :username, :email, :password)');
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT)); // Hash het wachtwoord
        return $this->db->execute();
    }

    // Haal gebruiker op op basis van e-mailadres
    public function getUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        return $this->db->single(); // Retourneert een object
    }

    // Haal gebruiker op op basis van gebruikersnaam
    public function getUserByUsername($username) {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        return $this->db->single(); // Retourneert een object
    }

    // Haal gebruiker op op basis van ID
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single(); // Retourneert een object
    }

    // Update gebruikersprofiel
    public function updateUserProfile() {
        $this->db->query('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id');
        $this->db->bind(':firstname', $this->firstname);
        $this->db->bind(':lastname', $this->lastname);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':id', $this->id);
        return $this->db->execute();
    }


    // Verwijder gebruiker
    public function deleteUser($id) {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
