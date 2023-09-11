<?php

namespace App\Repository;

use Psr\Container\ContainerInterface;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\EntityManagerInterface;

class BlogPostRepositoryFactory
{
    public function __invoke(ContainerInterface $container): BlogPostRepository
    {
        $entityManager = $container->get(EntityManagerInterface::class);
        return new BlogPostRepository($entityManager);
    }
}
