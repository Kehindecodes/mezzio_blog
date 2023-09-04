<?php

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;



class ViewPostHandler implements RequestHandlerInterface
{



    // display a single post using its id

    public function handle(ServerRequestInterface  $request): ResponseInterface
    {
        $id = (int)$request->getAttribute('id');
        $posts = include __DIR__ . '../../../../../data/posts.php';


        $post = array_filter($posts, function ($post) use ($id) {
            return $post['id'] === $id;
        });

        if (empty($post)) {
            return new JsonResponse(['error' => 'Post not found'], 404);
        }

        $post = array_shift($post);
        return new JsonResponse($post);
    }
}
