<?php

namespace App\Models;

use App\Models\Database;

class Hobby {
    private $db;

    public $id;
    public $user_id;  // Aangepast naar user_id
    public $name;
    public $description;
    public $image_url;

    public function __construct() {
        $this->db = new Database();
    }

    // Zoek hobby's op basis van user_id
    public static function findByUserId($userId) {
        $db = new Database();
        $db->query('SELECT * FROM hobbies WHERE user_id = :user_id');
        $db->bind(':user_id', $userId);
        return $db->resultSet();
    }

    // Zoek specifieke hobby op basis van id
    public static function find($id) {
        $db = new Database();
        $db->query('SELECT * FROM hobbies WHERE id = :id');
        $db->bind(':id', $id);
        return $db->single();
    }

    // Opslaan van hobby
    public function save() {
        $this->db->query('INSERT INTO hobbies (user_id, name, description, image_url) VALUES (:user_id, :name, :description, :image_url)');
        $this->db->bind(':user_id', $this->user_id);
        $this->db->bind(':name', $this->name);
        $this->db->bind(':description', $this->description);
        $this->db->bind(':image_url', $this->image_url);

        if ($this->db->execute()) {
            return true;
        } else {
            error_log("Failed to save hobby: " . print_r($this->db->errorInfo(), true));
            return false;
        }
    }

    // Hobby bijwerken
    public function update() {
        $this->db->query('UPDATE hobbies SET name = :name, description = :description, image_url = :image_url WHERE id = :id');
        $this->db->bind(':name', $this->name);
        $this->db->bind(':description', $this->description);
        $this->db->bind(':image_url', $this->image_url);
        $this->db->bind(':id', $this->id);

        if ($this->db->execute()) {
            return true;
        } else {
            error_log("Failed to update hobby: " . print_r($this->db->errorInfo(), true));
            return false;
        }
    }

    // Hobby verwijderen
    public function delete() {
        $this->db->query('DELETE FROM hobbies WHERE id = :id');
        $this->db->bind(':id', $this->id);
        return $this->db->execute();
    }
}
