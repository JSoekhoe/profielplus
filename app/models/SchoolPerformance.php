<?php
namespace App\Models;

use App\Models\Database;

class SchoolPerformance {
    private $db;

    public $id;
    public $user_id; // Use user_id
    public $institution;
    public $degree;
    public $field_of_study;
    public $start_date;
    public $end_date;
    public $grade;

    public function __construct(Database $db) {
        $this->db = $db; // Inject Database instance
    }

    // Find all school performances based on user_id
    public static function findByUserId(Database $db, $userId) {
        $db->query('SELECT * FROM school_performance WHERE user_id = :user_id');
        $db->bind(':user_id', $userId);
        return $db->resultSet(); // Returns an array of school performances
    }

    public static function find(Database $db, $id): ?SchoolPerformance {
        $db->query("SELECT * FROM school_performance WHERE id = :id");
        $db->bind(':id', $id);
        $result = $db->single(); // Retrieve the single result

        if ($result) {
            $schoolPerformance = new self($db); // Create a new instance of SchoolPerformance
            // Map the result to the SchoolPerformance properties
            $schoolPerformance->id = $result->id;
            $schoolPerformance->user_id = $result->user_id;
            $schoolPerformance->institution = $result->institution;
            $schoolPerformance->degree = $result->degree;
            $schoolPerformance->field_of_study = $result->field_of_study;
            $schoolPerformance->start_date = $result->start_date;
            $schoolPerformance->end_date = $result->end_date;
            $schoolPerformance->grade = $result->grade;

            return $schoolPerformance; // Return the SchoolPerformance instance
        }

        return null; // Return null if no result is found
    }


    // Save a new school performance
    public function save() {
        $this->db->query('INSERT INTO school_performance (user_id, institution, degree, field_of_study, start_date, end_date, grade) VALUES (:user_id, :institution, :degree, :field_of_study, :start_date, :end_date, :grade)');
        $this->db->bind(':user_id', $this->user_id);
        $this->db->bind(':institution', $this->institution);
        $this->db->bind(':degree', $this->degree);
        $this->db->bind(':field_of_study', $this->field_of_study);
        $this->db->bind(':start_date', $this->start_date);
        $this->db->bind(':end_date', $this->end_date);
        $this->db->bind(':grade', $this->grade);

        if ($this->db->execute()) {
            return true;
        } else {
            throw new \Exception("Failed to save performance: " . print_r($this->db->errorInfo(), true));
        }
    }

    // Update an existing school performance
    public function update() {
        $this->db->query('UPDATE school_performance SET institution = :institution, degree = :degree, field_of_study = :field_of_study, start_date = :start_date, end_date = :end_date, grade = :grade WHERE id = :id');
        $this->db->bind(':institution', $this->institution);
        $this->db->bind(':degree', $this->degree);
        $this->db->bind(':field_of_study', $this->field_of_study);
        $this->db->bind(':start_date', $this->start_date);
        $this->db->bind(':end_date', $this->end_date);
        $this->db->bind(':grade', $this->grade);
        $this->db->bind(':id', $this->id); // Bind ID for update

        if ($this->db->execute()) {
            return true;
        } else {
            throw new \Exception("Failed to update performance: " . print_r($this->db->errorInfo(), true));
        }
    }

    // Delete a school performance
    public function delete() {
        $this->db->query('DELETE FROM school_performance WHERE id = :id');
        $this->db->bind(':id', $this->id); // Bind ID for deletion
        return $this->db->execute(); // Execute delete query
    }
}
