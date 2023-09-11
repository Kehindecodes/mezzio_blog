<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class UpdatePostFactory
{
    public function __invoke(ContainerInterface $container) : UpdatePost
    {
        return new UpdatePost();
    }
}
