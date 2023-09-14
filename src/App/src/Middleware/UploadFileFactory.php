<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class UploadFileFactory
{
    public function __invoke(ContainerInterface $container) : UploadFile
    {
        return new UploadFile();
    }
}
