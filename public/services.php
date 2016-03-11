<?php

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider());

$app['user_repository'] = $app->share((function($app)use($em) {
    $user = new \muller\Entity\User();

    $repo = $em->getRepository('muller\Entity\User');
    $repo->setPasswordEncoder($app['security.encoder_factory']->getEncoder($user));
    return $repo;
}));


$app->register(new \Silex\Provider\SessionServiceProvider());
$app->register(new \Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'admin' => array(
            'anonymous' => true,
            'pattern' => '^/',
            'form' => array(
                'login_path' => '/login',
                'check_path' => '/admin/login_check'),
            'users' => $app->share(function() use($app) {
                return $app['user_repository'];
            }),
            'logout' => array('logout_path' => '/admin/logout')
        )
    )
));

$app['security.access_rules'] = array(
    array('^/admin','ROLE_ADMIN')
);

$app['getPosts'] = function() use($em) {
    $query = $em->createQuery("SELECT p FROM \muller\Entity\Post p");
    return $query->getResult();
};
