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

        $postData = $request->getParsedBody();

        $newPost = $this->blogPostRepository->createBlogPost($postData);

        return new JsonResponse([
            'message' => 'Post created successfully',
            'data' => $newPost,
        ], 201);
    }
}
