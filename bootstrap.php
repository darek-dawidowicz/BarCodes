<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Noodlehaus\Config;

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src/Entity"), $isDevMode, null, null, false);

// database configuration parameters
$dbConfig = Config::load('config/config.yml');

$conn = [
    'driver' => $dbConfig->get('db.driver'),
    'user' => $dbConfig->get('db.user'),
    'password' => $dbConfig->get('db.password'),
    'host' => $dbConfig->get('db.host'),
    'dbname' => $dbConfig->get('db.dbname'),
];

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);