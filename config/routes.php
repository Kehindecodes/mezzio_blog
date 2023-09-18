<?php

declare(strict_types=1);

use Mezzio\Application;
use App\Middleware\ListPosts;
use Mezzio\MiddlewareFactory;
use App\Middleware\CreatePost;
use App\Middleware\UploadFile;
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

    // $app->get('/posts/:id', App\Handler\ViewPostHandler::class, 'post.view');
    $app->get('/posts/:id', App\Middleware\GetPost::class, 'post.view');

    // $app->get('/posts', App\Handler\ListPostsHandler::class, 'posts.list');
    $app->get('/posts', ListPosts::class, 'posts.list');
    // $app->post('/posts', App\Handler\CreatePostHandler::class, 'posts.create');

    $app->post('/posts/:id', App\Middleware\UpdatePost::class, 'posts.update');
    $app->delete('/posts/:id', App\Middleware\DeletePost::class, 'posts.delete');

    // $app->post('/upload', App\Middleware\UploadFile::class, 'upload');

    // $app->put('/posts/:id', App\Handler\UpdatePostHandler::class, 'posts.update');


    $app->post('/posts', [
        UploadFile::class,
        CreatePost::class,
    ], 'createPost');
    // $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
    // $app->get('/hello', App\Handler\HelloWorldHandler::class, 'hello');
};
