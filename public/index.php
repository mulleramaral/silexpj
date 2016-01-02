<?php

require_once '../vendor/autoload.php';

//Definição do Array
$posts = array(
    array(
        'id' => 0,
        'post' => "post zero"
    ),
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
);

$app = new Silex\Application();
$app['debug'] = true;

// Definição da rota com o id
$app->get('/posts/{id}', function($id) use ($posts){
    foreach ($posts as $post) {
        if(in_array($id,$post)){
            return $post['id'] . ' - ' . $post['post'];
        }
    }
    return 'Post não foi encontrado.';
});

$app->run();