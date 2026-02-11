<?php

namespace Core;

use Core\Session;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if ($user) {
            // we have a user, but we dont know if the password provided matches what we have in the database
            if (password_verify($password, $user['password'])) {
                // log in the user if the credentials match
                $this->login([ 
                    'email' => $email
                ]);

                return true;
            }
        }

        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}