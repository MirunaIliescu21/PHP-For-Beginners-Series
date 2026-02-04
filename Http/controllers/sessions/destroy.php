<?php

use Core\Authenticator;

// Log the user out via Authenticator
$auth = new Authenticator();
$auth->logout();

// Redirect to home
redirect('/');
