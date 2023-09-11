<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use App\Repository\BlogPostRepository;

class GetPostFactory
{
    public function __invoke(ContainerInterface $container): GetPost
    {

        $blogRepository = $container->get(BlogPostRepository::class);
        return new GetPost($blogRepository);
    }
}
