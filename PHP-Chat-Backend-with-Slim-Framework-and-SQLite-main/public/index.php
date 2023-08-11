<?php

use Slim\Factory\AppFactory;

require dirname(__DIR__) . '/src/ChatBackend/routes/routes.php';

require_once __DIR__ . "/../vendor/autoload.php";

$app = AppFactory::create();

$app->run();