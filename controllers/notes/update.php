<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

$id = $_POST['id'] ?? null;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $id
])->findOrFail(); 

authorize($note['user_id'] === $currentUserId);

$errors=[];

if(! Validator::string($_POST['body'], 1, 1024)) {
    $errors['body'] = 'A body of no more than 1024 characters is required';
}

if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

header('location: /notes');

die();