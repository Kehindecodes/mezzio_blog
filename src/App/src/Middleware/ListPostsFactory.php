<?php

declare(strict_types=1);

namespace App\Middleware;

use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;
use App\Repository\BlogPostRepository;

class ListPostsFactory
{
    public function __invoke(ContainerInterface $container): ListPosts
    {
        $blogRepository = $container->get(BlogPostRepository::class);
        // Create and return an instance of the middleware
        return new ListPosts($blogRepository);
    }
}
