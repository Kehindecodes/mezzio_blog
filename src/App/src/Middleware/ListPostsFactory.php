<?php

declare(strict_types=1);

namespace App\Middleware;

use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;

class ListPostsFactory
{
    public function __invoke(ContainerInterface $container): ListPosts
    {
        $postData = include __DIR__ . '../../../../../data/posts.php';
        // Create and return an instance of the middleware
        return new ListPosts($postData);
    }
}
