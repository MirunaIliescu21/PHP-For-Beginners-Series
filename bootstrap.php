<?php

use Core\Container;
use Core\Database;
use Core\App;

$container = new Container();

$container->bind('Core\Database', function() {
    $config = require base_path('config.php');
    // Connect to my SQL database with PDO (PHP DATA OBJECTS) and execute a query.
    return new Database($config['database'], 'lesson12_user', 'lesson12_pass');
});

// $db = $container->resolve('Core\Database');

App::setContainer($container);
