<?php

declare(strict_types=1);

namespace App\Middleware;

use Cloudinary\Cloudinary;
use Psr\Container\ContainerInterface;

class UploadFileFactory
{
    public function __invoke(ContainerInterface $container): UploadFile
    {

        $cloudinary = $container->get(Cloudinary::class);
        return new UploadFile($cloudinary);
    }
}
