<?php

// Registrando Twig e definindo caminho para views
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '\..\views',
));

//Registrando UrlGeneratorServiceProvider
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

//Não coloquei $app->share(); por que acredito que essa versão do pimple ja utilize a mesma instancia.
// fiz a comparação usando 3 iguais e informa que eh igual ja

$app['getPosts'] = function(){
    return array(
    array(
        'id' => 1,
        'post' => "post um"
    ),
    array(
        'id' => 2,
        'post' => "post dois"
    ),
    array(
        'id' => 3,
        'post' => "post tres"
    ),
    array(
        'id' => 4,
        'post' => "post quatro"
    ),
    array(
        'id' => 5,
        'post' => "post cinco"
    ),
    array(
        'id' => 6,
        'post' => "post seis"
    ),
    array(
        'id' => 7,
        'post' => "post sete"
    ),
    array(
        'id' => 8,
        'post' => "post oito"
    ),
    array(
        'id' => 9,
        'post' => "post nove"
    ),
    array(
        'id' => 10,
        'post' => "post dez"
    )
);};