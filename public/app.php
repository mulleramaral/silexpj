<?php

$app = new Silex\Application();
$app['debug'] = true;

// Registrando Twig e definindo caminho para views
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '\..\views',
));