<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$id = $_GET['id'] ?? null;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $id
])->findOrFail(); // if note not found, findOrFail will abort with 404

// the note exists, but is unauthorized
authorize($note['user_id'] === $currentUserId);

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);
