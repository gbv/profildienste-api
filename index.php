<?php

require 'vendor/autoload.php';

require 'init.php';
require 'errorHandler.php';
require 'routes.php';

use Middleware\AuthMiddleware;
use Middleware\JSONPMiddleware;

$slimConfiguration = [
    'settings' => [
        'displayErrorDetails' => false,
    ]
];

/**
 * Initialise the DI container and error handling
 */
$container = new \Slim\Container($slimConfiguration);
initErrorHandling($container);
initContainer($container);

/**
 * Create the app and init define all available routes
 */
$app = new \Slim\App($container);

$app->add(new JSONPMiddleware());
$auth = new AuthMiddleware($container);

initRoutes($app);

$app->run();

