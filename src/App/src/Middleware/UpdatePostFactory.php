<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use App\Repository\BlogPostRepository;

class UpdatePostFactory
{
    public function __invoke(ContainerInterface $container): UpdatePost
    {
        $blogRepository = $container->get(BlogPostRepository::class);
        return new UpdatePost($blogRepository);
    }
}
