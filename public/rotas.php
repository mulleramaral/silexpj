<?php
//Definição de Rotas


// EU GOSTARIA DE SABER SE É POSSÍVEL DEFINIR OS DOIS COM O MESMO CAMINHO /POSTS POREM HORA RECEBE ID E HORA NÃO
// SE PUDER DEIXE NA CORREÇÃO DO PROJETO
// Rota Posts
$app->get('/posts', function(Silex\Application $app) use($posts) {
            return $app['twig']->render('posts.twig', array(
                        'posts' => $posts));
        })
        ->bind('/posts');

// Rota post para um post apenas
$app->get('/post/{id}', function(Silex\Application $app,$id) use ($posts){
    foreach ($posts as $post) {
        if(in_array($id,$post)){
            $p = array(
                'id' => $post['id'],
                'post' => $post['post']
            );
            return $app['twig']->render('post.twig',array(
               'post' => $p 
            ));
        }
    }
    return "Nao foi encontrado";    
})->bind('/post')->assert('id','\d+');

        
//$app->get('/posts',function() use ($posts){
//    $html = "";
//    foreach ($posts as $post) {
//        $html .= $post['id'] . '-' . $post['post'] . '<br>';
//    }
//    return $html;
//});

//$app->get('/posts/{id}', function($id) use ($posts){
//    foreach ($posts as $post) {
//        if(in_array($id,$post)){
//            return $post['id'] . ' - ' . $post['post'];
//        }
//    }
//    return 'Post não foi encontrado.';
//});

