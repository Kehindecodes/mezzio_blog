<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Repository\BlogPostRepository;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;

class CreatePostFactory
{
    public function __invoke(ContainerInterface $container): CreatePost
    {
        $blogRepository = $container->get(BlogPostRepository::class);
        return new CreatePost($blogRepository);
    }
}
