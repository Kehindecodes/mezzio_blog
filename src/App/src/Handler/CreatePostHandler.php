<?php

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;




class CreatePostHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $posts = include __DIR__ . '../../../../../data/posts.php';
        $updatedPost = [];

        $reqBody = $request->getParsedBody();
        // set request body to $updatedPost
        $id = isset($reqBody['id']) ? $reqBody['id'] : null;
        $title = $reqBody['title'] ?? null;
        $image = $reqBody['image'] ?? null;
        $category = $reqBody['category'] ?? null;
        $content = $reqBody['content'] ?? null;

        $updatedPost['id'] = intval($id);
        $updatedPost['title'] = $title;
        $updatedPost['image'] = $image;
        $updatedPost['category'] = $category;
        $updatedPost['body'] = $content;

        // set updated post to $posts
        $posts[] = $updatedPost;
        return new JsonResponse($posts);
    }
}
