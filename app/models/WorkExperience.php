<?php

namespace App\Models;

use App\Models\Database;

class WorkExperience {
    private $db;

    public $id;
    public $user_id; // Gebruik user_id
    public $company;
    public $job_title;
    public $position; // Verander job_title naar position
    public $start_date;
    public $end_date;
    public $description;

    public function __construct(Database $db) {
        $this->db = $db; // Injecteer Database instantie
    }

    public static function findByUserId(Database $db, $userId) {
        $db->query('SELECT * FROM work_experience WHERE user_id = :user_id');
        $db->bind(':user_id', $userId);
        return $db->resultSet(); // Retourneert een array van werkervaringen
    }

    public static function find(Database $db, $id): ?WorkExperience {
        $db->query('SELECT * FROM work_experience WHERE id = :id');
        $db->bind(':id', $id);
        $result = $db->single();

        if ($result) {
            $workexperience = new self($db); // Create a new instance of workexperience
            // Map the result to the workexperience properties
            $workexperience->id = $result->id;
            $workexperience->user_id = $result->user_id;
            $workexperience->job_title = $result->job_title;
            $workexperience->company = $result->company;
            $workexperience->description = $result->description;
            $workexperience->start_date = $result->start_date;
            $workexperience->end_date = $result->end_date;

            return $workexperience; // Return the workexperience instance
        }
        return null;
    }

    public function save() {
        $this->db->query('INSERT INTO work_experience (user_id, company, job_title, start_date, end_date, description) VALUES (:user_id, :company, :job_title, :start_date, :end_date, :description)');
        $this->db->bind(':user_id', $this->user_id);
        $this->db->bind(':company', $this->company);
        $this->db->bind(':job_title', $this->job_title); // Correcte binding
        $this->db->bind(':start_date', $this->start_date);
        $this->db->bind(':end_date', $this->end_date);
        $this->db->bind(':description', $this->description);

        if ($this->db->execute()) {
            return true;
        } else {
            throw new \Exception("Failed to save work experience: " . print_r($this->db->errorInfo(), true));
        }
    }


    public function update() {
        $this->db->query('UPDATE work_experience SET company = :company, job_title = :job_title,  start_date = :start_date, end_date = :end_date, description = :description WHERE id = :id');
        $this->db->bind(':company', $this->company);
        $this->db->bind(':job_title', $this->job_title);
        $this->db->bind(':start_date', $this->start_date);
        $this->db->bind(':end_date', $this->end_date);
        $this->db->bind(':description', $this->description);
        $this->db->bind(':id', $this->id); // Bind ID voor bijwerken

        if ($this->db->execute()) {
            return true;
        } else {
            throw new \Exception("Failed to update work experience: " . print_r($this->db->errorInfo(), true));
        }
    }

    public function delete() {
        $this->db->query('DELETE FROM work_experience WHERE id = :id');
        $this->db->bind(':id', $this->id); // Bind ID voor verwijdering
        return $this->db->execute(); // Voer verwijderingsquery uit
    }
}
