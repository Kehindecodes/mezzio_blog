<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use App\Repository\BlogPostRepository;
use Cloudinary\Cloudinary;

class UpdatePostFactory
{
    public function __invoke(ContainerInterface $container): UpdatePost
    {
        $blogRepository = $container->get(BlogPostRepository::class);
        $cloudinary =   $container->get(Cloudinary::class);
        return new UpdatePost($blogRepository, $cloudinary);
    }
}
