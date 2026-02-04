<?php

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

/** If the form did not validate, return the errors */
if (! $form->validate($email, $password))
{
    return view('sessions/create.view.php', [
        'errors' => $form->errors()
    ]);
}

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();


if ($user) {
    // we have a user, but we dont know if the password provided matches what we have in the database

    if (password_verify($password, $user['password'])) {
        // log in the user if the credentials match
        login([
            'email' => $email
        ]);

        header('location: /');
        exit();
    }
}


// we dont have a user or the password validation failed
return view('sessions/create.view.php', [
    'errors' => [
        'email' => 'No matching account found for that email address and password.'
    ]
]);

