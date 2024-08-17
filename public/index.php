<?php

declare(strict_types=1);

use application\core\Application;
use application\controllers\HomeController;

// Define the root directory of the application
define('ROOT_DIR', dirname(__DIR__));

// Include the Composer autoloader to load the application classes
// This is a standard step in PHP application setup
require_once ROOT_DIR .
    DIRECTORY_SEPARATOR . 'vendor' .
    DIRECTORY_SEPARATOR . 'autoload.php';

// Create a new instance of the Application class
$application = new Application();


// Register a GET route for the root path ('/') that maps to the 'index' action
// of the 'HomeController'.
$application->router->get('/', [HomeController::class, 'index']);
$application->router->post('/', [HomeController::class, 'index']);

// Run the application
$application->run();
