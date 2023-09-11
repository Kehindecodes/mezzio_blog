<?php

use App\Middleware\ListPosts;
use App\Middleware\ListPostsFactory;



return [
    'dependencies' => [
        'factories' => [
            // Register your middleware factory here
            ListPosts::class => ListPostsFactory::class,
        ],
    ],

    'middleware _ pipeline' => [
        'always' => [],
        'routing' => [
            'middleware' => [
                ListPosts::class
            ],

        ]
    ],

];
