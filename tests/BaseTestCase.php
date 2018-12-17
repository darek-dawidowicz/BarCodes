<?php

namespace Tests;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Noodlehaus\Config;

/**
 * Class BaseTestCase
 *
 * @package Tests
 */
class BaseTestCase extends TestCase
{

    /**
     * @var EntityManager
     */
    protected static $em;

    /**
     * The setUpBeforeClass() and tearDownAfterClass() template methods are called before the first test of the test case class is run
     * and after the last test of the test case class is run, respectively.
     */
    public static function setUpBeforeClass()
    {

        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src/Entity"), $isDevMode, null, null, false);

        $dbConfig = Config::load('config/config.yml');

        $conn = [
            'driver' => $dbConfig->get('db.driver'),
            'user' => $dbConfig->get('db.user'),
            'password' => $dbConfig->get('db.password'),
            'host' => $dbConfig->get('db.host'),
            'dbname' => $dbConfig->get('db.dbname'),
        ];

        self::$em = EntityManager::create($conn, $config);
    }

    /**
     *
     */
    public static function tearDownAfterClass()
    {
        self::$em = null;
    }
}