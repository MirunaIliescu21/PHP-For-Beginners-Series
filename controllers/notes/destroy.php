<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

// form was submitted. delete the current note.
$id = $_POST['id'] ?? null;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $id
])->findOrFail(); // if note not found, findOrFail will abort with 404

// the note exists, but is unauthorized
authorize($note['user_id'] === $currentUserId);

$db->query('delete from notes where id = :id', [
    'id' => $_POST['id']
]);

header('location: /notes');
exit();