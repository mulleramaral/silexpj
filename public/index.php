<?php

require_once '../vendor/autoload.php';
require_once './app.php';
require_once './services.php';

$app->get('/',function(Silex\Application $app){
    return $app['twig']->render('index.twig');
})->bind('/');

$app->mount('/posts', include_once './posts.php');

$app->run();