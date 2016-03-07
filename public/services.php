<?php
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '\..\views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider());

$app['getPosts'] = function() use($em){
    $query = $em->createQuery("SELECT p FROM muller\Entity\Post p");
    return $query->getResult();
};
