<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Factory\CloudinaryFactory;
use Cloudinary\Cloudinary;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;
use App\Repository\BlogPostRepository;
use Psr\Http\Message\ServerRequestInterface;

class CreatePostFactory
{
    public function __invoke(ContainerInterface $container): CreatePost
    {
        $blogRepository = $container->get(BlogPostRepository::class);

        $cloudinary = $container->get(Cloudinary::class);

        return new CreatePost(
            $blogRepository,
            $cloudinary
        );
    }
}
