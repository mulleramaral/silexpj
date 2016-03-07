<?php

// Controller Posts

use Symfony\Component\HttpFoundation\Request;

$posts = $app['controllers_factory'];

# Página de sucesso #
$app->get('/post/sucesso', function(Silex\Application $app) {
    return $app['twig']->render('sucesso.twig', array());
})->bind('/post/sucesso');

$app->get('/post/erro',function(Silex\Application $app){
    return $app['twig']->render('erro.twig',array());
})->bind('/post/erro');

$posts->get('/', function(Silex\Application $app) use($em){
    return $app['twig']->render('posts.twig', array('posts' => $app['getPosts']));
})->bind('/posts');

// Rota post para um post apenas
$posts->get('/visualizar/{id}', function(Silex\Application $app, $id) use($em){
    $post = $em->getRepository('muller\Entity\Post')->find($id);
    if(!$post)
        $app->abort (500,'Não foi possivel encontrar o post.');
    
    return $app['twig']->render('post.twig',array('post' => $post));
})->bind('/post/visualizar')->assert('id', '\d+');


# Rotas de cadastro #
$app->get('/post/novo', function(Silex\Application $app) {
    return $app['twig']->render('novopost.twig', array());
})->bind('/post/novo');

$app->post('/post/new', function(Silex\Application $app, Request $request) use($em) {
    $data = $request->request->all();

    $post = new \muller\Entity\Post;
    $post->setTitulo($data['titulo']);
    $post->setConteudo($data['conteudo']);

    $em->persist($post);
    $em->flush();

    if ($post->getId()) {
        return $app->redirect($app['url_generator']->generate('/post/sucesso'));
    } else {
        $app->abort(500, 'Erro de processamento');
    }
})->bind('/new');

# Editar #
$app->get('/post/editar/{id}', function(Silex\Application $app,$id) use($em){
    $post = $em->getRepository('muller\Entity\Post')->find($id);
    return $app['twig']->render('editarpost.twig', array('post'=> $post));
})->bind('/post/editar')->assert('id', '\d+');

$app->put('/post/update/{id}', function(Silex\Application $app,Request $request,$id) use($em) {
    $data = $request->request->all();
    $post = $em->getRepository('muller\Entity\Post')->find($id);
    $post->setTitulo($data['titulo']);
    $post->setConteudo($data['conteudo']);
    $em->flush();
    if($post->getId()){
        return $app->redirect($app['url_generator']->generate('/post/sucesso'));
    }
    else{
        $app->abort(500,'Erro de processamento');
    }
})->bind('/post/update');

# Excluir #
$app->get('/post/excluir/{id}',function(Silex\Application $app,$id) use($em){
    $post = $em->getRepository('muller\Entity\Post')->find($id);
    
    if(!$post)
        $app->abort (500,'Não foi possível encontrar o post');
    
    try{
       $em->remove($post);
       $em->flush();
    } catch(Doctrine\ORM\ORMInvalidArgumentException $ex){
        $app->abort(500,'Erro de processoamento.Erro:' . $ex->getMessage());
    }
    catch (Doctrine\ORM\ORMException $ex) {
        $app->abort(500,'Erro de processamento.Erro: ' . $ex->getMessage());
    }
    return $app->redirect($app['url_generator']->generate('/posts'));
})->bind('/post/excluir');

return $posts;
