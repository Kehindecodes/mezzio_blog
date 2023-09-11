<?php

declare(strict_types=1);

use App\Middleware\CreatePost;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * laminas-router route configuration
 *
 * @see https://docs.laminas.dev/laminas-router/
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', App\Handler\HomePageHandler::class, 'home');

    $app->get('/posts/:id', App\Handler\ViewPostHandler::class, 'post.view');

    // $app->get('/posts', App\Handler\ListPostsHandler::class, 'posts.list');
    $app->get('/posts', App\Middleware\ListPosts::class, 'posts.list');
    // $app->post('/posts', App\Handler\CreatePostHandler::class, 'posts.create');

    // $app->put('/posts/:id', App\Middleware\UpdatePost::class, 'posts.update');

    $app->put('/posts/:id', App\Handler\UpdatePostHandler::class, 'posts.update');


    $app->post('/posts', [
        CreatePost::class,
    ], 'createPost');
    // $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
    // $app->get('/hello', App\Handler\HelloWorldHandler::class, 'hello');
};
