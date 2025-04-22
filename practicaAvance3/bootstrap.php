<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration([__DIR__."/model"], $isDevMode, $proxyDir, null, $useSimpleAnnotationReader);
$config->setResultCache($cache);
// or if you prefer yaml or XML
// $config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
// $config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$connectionParams = [
    'dbname' => 'bentatecnologies_database',
    'user'   => 'root',
    'password' => '',
    'host'   => 'localhost',
    'driver' => 'pdo_mysql',
];

// obtaining the entity manager
$em = EntityManager::create($connectionParams, $config);