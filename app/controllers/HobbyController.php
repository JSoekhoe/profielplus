<?php

namespace App\Controllers;

use App\Models\Hobby;
use App\Models\Database;

class HobbyController extends BaseController
{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Lijst van hobby's
    public function index($userId) {
        $hobbies = Hobby::findByUserId($userId);
        $this->render('dashboard', ['hobbies' => $hobbies]);
    }

    // Formulier weergeven voor nieuwe hobby
    public function create($userId) {
        $this->render('hobby/create', ['userId' => $userId]);
    }

    // Nieuwe hobby opslaan
    public function store() {
        $hobby = new Hobby();
        $hobby->user_id = $_POST['user_id'];  // Gebruik user_id in plaats van profile_id
        $hobby->name = $_POST['name'];
        $hobby->description = $_POST['description'];
        $hobby->image_url = $_POST['image_url'];
        $hobby->save();

        header('Location: /dashboard/' . $_POST['user_id']);  // Correcte redirect
    }

    // Hobby bewerken
    public function edit($id) {
        $hobby = Hobby::find($id);
        $this->render('hobby/edit', ['hobby' => $hobby]);
    }

    // Update van hobby opslaan
    public function update($id) {
        $hobby = Hobby::find($id);
        $hobby->name = $_POST['name'];
        $hobby->description = $_POST['description'];
        $hobby->image_url = $_POST['image_url'];
        $hobby->update();

        header('Location: /dashboard/' . $hobby->user_id);  // Correcte redirect
    }

    // Hobby verwijderen
    public function delete($id) {
        $hobby = Hobby::find($id);
        $userId = $hobby->user_id;  // Gebruik user_id in plaats van profile_id
        $hobby->delete();

        header('Location: /dashboard/' . $userId);  // Correcte redirect
    }
}
