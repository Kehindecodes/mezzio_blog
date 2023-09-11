<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class DatabaseStatusCheckerFactory
{
    public function __invoke(ContainerInterface $container): DatabaseStatusChecker
    {
        $entityManager = $container->get(EntityManagerInterface::class);


        return new DatabaseStatusChecker($entityManager);
    }
}
