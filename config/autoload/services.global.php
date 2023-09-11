<?php

return [
    'dependencies' => [
        'factories' => [
            // ...
            \App\Repository\BlogPostRepository::class => \App\Repository\BlogPostRepositoryFactory::class,
        ],
    ],
];
