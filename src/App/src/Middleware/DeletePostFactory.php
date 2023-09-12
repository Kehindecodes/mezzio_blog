<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use App\Repository\BlogPostRepository;

class DeletePostFactory
{
    public function __invoke(ContainerInterface $container): DeletePost
    {
        $blogRepository = $container->get(BlogPostRepository::class);

        return new DeletePost($blogRepository);
    }
}
