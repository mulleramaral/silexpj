<?php

require_once '../vendor/autoload.php';
require_once './app.php';
require_once './services.php';

$app->mount('/posts', include_once './posts.php');

$app->run();
