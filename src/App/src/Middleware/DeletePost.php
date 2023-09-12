<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Repository\BlogPostRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeletePost implements MiddlewareInterface
{

    public function __construct(private BlogPostRepository $blogRepository)
    {
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $postId = $request->getAttribute('id');

        $deleted = $this->blogRepository->removePost($postId);

        if (!$deleted) {
            // Handle the case where no post with the given ID was found
            return new JsonResponse(['message' => 'Post not found'], 404);
        }

        return new JsonResponse(['message' => 'Post deleted successfully']);
    }
}
