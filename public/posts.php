<?php
// Controller Posts
$posts = $app['controllers_factory'];

$posts->get('/', function(Silex\Application $app) {
            return $app['twig']->render('posts.twig', array(
                        'posts' => $app['getPosts']));
        })
        ->bind('/posts');

// Rota post para um post apenas
$posts->get('/{id}', function(Silex\Application $app,$id){
    foreach ($app['getPosts'] as $post) {
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
