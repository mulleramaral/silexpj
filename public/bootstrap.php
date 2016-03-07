<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\EventManager as EventManager,
    Doctrine\ORM\Events,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Cache\ArrayCache as Cache,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\Common\ClassLoader;

$cache = new Cache();

$annotationReader = new Doctrine\Common\Annotations\AnnotationReader;
$cachedAnnotationReader = new Doctrine\Common\Annotations\CachedReader(
        $annotationReader, $cache
);

$driverChain = new Doctrine\ORM\Mapping\Driver\DriverChain();

Gedmo\DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
        $driverChain, $cachedAnnotationReader
);

$annotationDriver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
        $cachedAnnotationReader, array(__DIR__ . DIRECTORY_SEPARATOR . '../src'));

$driverChain->addDriver($annotationDriver, 'muller');


$config = new Doctrine\ORM\Configuration();
$config->setProxyDir('/tmp');
$config->setProxyNamespace('Proxy');
$config->setAutoGenerateProxyClasses(true);

$config->setMetadataDriverImpl($driverChain);
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

AnnotationRegistry::registerFile(__DIR__ . DIRECTORY_SEPARATOR . '../vendor' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . 'orm' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Doctrine' . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'Mapping' . DIRECTORY_SEPARATOR . 'Driver' . DIRECTORY_SEPARATOR . 'DoctrineAnnotations.php');

$evm = new EventManager;

$sluggableListener = new Gedmo\Sluggable\SluggableListener;
$sluggableListener->setAnnotationReader($cachedAnnotationReader);
$evm->addEventSubscriber($sluggableListener);

$em = EntityManager::create(array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'port' => '3306',
            'user' => 'root',
            'password' => '',
            'dbname' => 'silexpj'
                ), $config, $evm);
