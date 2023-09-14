<?php

use Cloudinary\Cloudinary;

return [
    'dependencies' => [
        'factories' => [
            // ...
            \App\Repository\BlogPostRepository::class => \App\Repository\BlogPostRepositoryFactory::class,
            Cloudinary::class => \App\Factory\CloudinaryFactory::class,
        ],
    ],
];
