<?php

namespace App\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $config = $container->get('config')['doctrine'];
        $isDevMode = true; // Set to false in production

        // Create a Doctrine ORM Configuration instance
        $doctrineConfig = ORMSetup::createAttributeMetadataConfiguration(
            $config['driver']['orm_default']['drivers'],
            $isDevMode
        );

        $parser = new DsnParser();
        $connectionParams = $parser->parse('mysqli://root@localhost/mezzioblog');


        // Create the EntityManager
        $conn = DriverManager::getConnection($connectionParams, $doctrineConfig);
        // $conn = DriverManager::getConnection($config['connection']['orm_default'], $doctrineConfig);
        return new EntityManager($conn, $doctrineConfig);
    }
}
