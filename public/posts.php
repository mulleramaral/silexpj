<?php
//Definição de Rotas
// Ola Obrigado pelo esclarecimento da duvida, poderia aprovar para que eu possa prosseguir para a etapa 3
// Controller Enquete

$posts = $app['controllers_factory'];

$posts->get('/', function(Silex\Application $app) use($dados) {
            return $app['twig']->render('posts.twig', array(
                        'posts' => $dados));
        })
        ->bind('/posts');

// Rota post para um post apenas
$posts->get('/{id}', function(Silex\Application $app,$id) use ($dados){
    foreach ($dados as $post) {
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

return $posts;
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

