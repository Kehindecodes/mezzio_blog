<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class DeletePostFactory
{
    public function __invoke(ContainerInterface $container) : DeletePost
    {
        return new DeletePost();
    }
}
