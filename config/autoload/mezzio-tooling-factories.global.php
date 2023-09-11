<?php

/**
 * This file generated by Mezzio\Tooling\Factory\ConfigInjector.
 *
 * Modifications should be kept at a minimum, and restricted to adding or
 * removing factory definitions; other dependency types may be overwritten
 * when regenerating this file via mezzio-tooling commands.
 */
 
declare(strict_types=1);

return [
    'dependencies' => [
        'factories' => [
            App\Handler\BlogPostHandler::class => App\Handler\BlogPostHandlerFactory::class,
            App\Middleware\CreatePost::class => App\Middleware\CreatePostFactory::class,
            App\Middleware\DatabaseStatusChecker::class => App\Middleware\DatabaseStatusCheckerFactory::class,
            App\Middleware\DeletePost::class => App\Middleware\DeletePostFactory::class,
            App\Middleware\ListPosts::class => App\Middleware\ListPostsFactory::class,
            App\Middleware\UpdatePost::class => App\Middleware\UpdatePostFactory::class,
        ],
    ],
];