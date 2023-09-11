
<?php

require 'vendor/autoload.php';

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\DBAL\Driver\Mysqli\Driver;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;

$config = new PhpFile(__DIR__ . '/../migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders
$paths = [__DIR__ . '/../src/App/src/Entity'];
$isDevMode = true;

$ORMconfig = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$parser = new DsnParser();
$connectionParams = $parser->parse('mysqli://root@localhost/mezzioblog');
$conn = DriverManager::getConnection($connectionParams, $ORMconfig);

// $conn = DriverManager::getConnection([
//     'driverClass' => Driver::class,
//     'params' => [
//         'host'     => 'localhost',
//         'port'     => '3306',
//         'user'     => 'root',
//         'password' => '',
//         'dbname'   => 'mezzioblog',
//         'driver' => 'pdo_mysql'
//     ],
// ]);
$entityManager = new EntityManager($conn, $ORMconfig);

return DependencyFactory::fromConnection($config, new ExistingConnection($conn));

// cli-config.php

// use Doctrine\ORM\Tools\Console\ConsoleRunner;

// // Replace with the path to your project's bootstrap file
// require_once '../boostrap.php';

// // Replace with the mechanism you use to retrieve the EntityManager in your application
// $entityManager = getEntityManager(); // Make sure you have a function like this in your bootstrap.php

// return ConsoleRunner::createHelperSet($entityManager);