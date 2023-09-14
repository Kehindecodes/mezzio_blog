<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Repository\BlogPostRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetPost implements MiddlewareInterface
{

    public function __construct(private BlogPostRepository $blogRepository)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // $response = $handler->handle($request);
        $id = (int)$request->getAttribute('id');

        $post = $this->blogRepository->getBlogPost($id);
        if (!$post) {
            return new JsonResponse(['message' => 'Post not found'], 404);
        }
        return new JsonResponse($post);
    }
}
