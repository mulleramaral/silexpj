<?php

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . DIRECTORY_SEPARATOR . '../vendor/autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'app.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'services.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'rotas.php';

Request::enableHttpMethodParameterOverride();

$app->run();
