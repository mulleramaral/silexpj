<?php

use \Symfony\Component\HttpFoundation\Request;

$app->get('/',function(Silex\Application $app){
    return $app['twig']->render('index.twig');
})->bind('/');

// Cria usuario Admin //
$app->get('/criaadmin',function() use($app){
    $repo = $app['user_repository'];
    $repo->createAdminUser('admin','admin');
    return 'Ola admin';
});

// Login
$app->get('/login',function(Request $request) use($app){
    return $app['twig']->render('login.twig',array(
       'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username')
    ));
})->bind('login');

$app->mount('/posts', include_once __DIR__ . DIRECTORY_SEPARATOR . 'posts.php');

