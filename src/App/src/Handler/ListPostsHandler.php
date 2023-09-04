<?php

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ListPostsHandler implements RequestHandlerInterface
{
    private $posts;

    public function __construct()
    {
        $this->posts = include __DIR__ . '../../../../../data/posts.php';
    }

    /**
     * Handles the server request and returns a JSON response.
     *
     * @param ServerRequestInterface $request The server request to handle.
     * @throws \Exception If there is an error.
     * @return ResponseInterface The JSON response.
     */

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse($this->posts);
    }
}
