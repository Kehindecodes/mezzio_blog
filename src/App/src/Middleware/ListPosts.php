<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Repository\BlogPostRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class ListPosts implements MiddlewareInterface
{



    public function __construct(private BlogPostRepository $blogRepository)
    {
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $posts = $this->blogRepository->getBlogPosts();

        if (!$posts) {
            return new JsonResponse(['message' => 'No posts to display'], 404);
        }
        // display posts
        return new JsonResponse($posts);
    }
}
