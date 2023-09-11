
<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);

$conn = array(
    'driver' => 'pdo_mysql',
    'user' => 'your_mysql_username',
    'password' => 'your_mysql_password',
    'dbname' => 'your_mysql_dbname',
);

$entityManager = EntityManager::create($conn, $config);
