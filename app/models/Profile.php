<?php

namespace App\Models;

class Profile {
    private $db;

    public $id;
    public $user_id;
    public $bio;
    public $phone;

    public function __construct() {
        $this->db = new Database();
    }

    // Vind profiel op basis van user_id
    public static function findByUserId($userId) {
        $db = new Database();
        $db->query('SELECT * FROM profile WHERE user_id = :user_id');
        $db->bind(':user_id', $userId);
        $data = $db->single();

        if (!$data) {
            return null; // Geen profiel gevonden
        }

        $profile = new self();
        $profile->id = $data->id;
        $profile->user_id = $data->user_id;
        $profile->bio = $data->bio;
        $profile->phone = $data->phone;

        return $profile;
    }

    // Maak een nieuw profiel aan
    public static function create($userId, $bio = null, $phone = null) {
        $db = new Database();
        $db->query('INSERT INTO profile (user_id, bio, phone) VALUES (:user_id, :bio, :phone)');
        $db->bind(':user_id', $userId);
        $db->bind(':bio', $bio);   // Zorg ervoor dat dit NULL kan zijn
        $db->bind(':phone', $phone); // Zorg ervoor dat dit NULL kan zijn
        return $db->execute();
    }

    // Bijwerken van het profiel
    public function update() {
        $this->db->query('UPDATE profile SET bio = :bio, phone = :phone WHERE user_id = :user_id');
        $this->db->bind(':bio', $this->bio);
        $this->db->bind(':phone', $this->phone);
        $this->db->bind(':user_id', $this->user_id);
        return $this->db->execute();
    }
}
