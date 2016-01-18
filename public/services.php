<?php

// Registrando Twig e definindo caminho para views
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '\..\views',
));

//Registrando UrlGeneratorServiceProvider
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());