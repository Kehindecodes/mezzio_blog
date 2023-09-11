<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Repository\BlogPostRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use App\Middleware\DatabaseStatusChecker;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CreatePost implements MiddlewareInterface
{
    public function __construct(private BlogPostRepository $blogPostRepository)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // $posts = include __DIR__ . '../../../../../data/posts.php';
        // $updatedPost = [];

        // $reqBody = $request->getParsedBody();
        // // set request body to $updatedPost
        // $id = isset($reqBody['id']) ? $reqBody['id'] : null;
        // $title = $reqBody['title'] ?? null;
        // $image = $reqBody['image'] ?? null;
        // $category = $reqBody['category'] ?? null;
        // $content = $reqBody['content'] ?? null;

        // $updatedPost['id'] = intval($id);
        // $updatedPost['title'] = $title;
        // $updatedPost['image'] = $image;
        // $updatedPost['category'] = $category;
        // $updatedPost['body'] = $content;

        // // set updated post to $posts
        // $posts[] = $updatedPost;


        // $response = $handler->handle($request);
        $postData = $request->getParsedBody();

        $newPost = $this->blogPostRepository->createBlogPost($postData);

        return new JsonResponse([
            'message' => 'Post created successfully',
            'data' => $newPost,
        ], 201);
    }
}
