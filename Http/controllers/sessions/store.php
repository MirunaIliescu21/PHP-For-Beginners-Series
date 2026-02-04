<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

/** If the form did validate, try to authenticate */
if ($form->validate($email, $password))
{
    $auth = new Authenticator();

    if ($auth->attempt($email, $password)) {
        redirect('/'); // redirect to home page on success and kill the script
    }
        
    $form->error('email', 'No matching account found for that email address and password.');
}

return view('sessions/create.view.php', [
    'errors' => $form->errors()
]);
