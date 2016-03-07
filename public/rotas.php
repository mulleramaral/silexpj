<?php

$app->get('/',function(Silex\Application $app){
    return $app['twig']->render('index.twig');
})->bind('/');

$app->mount('/posts', include_once __DIR__ . DIRECTORY_SEPARATOR . 'posts.php');