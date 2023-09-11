<?php

namespace App\Handler;

use App\Repository\BlogPostRepository;
use App\Service\DatabaseStatusChecker;
use Doctrine\ORM\Mapping\ClassMetadata;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;




class CreatePostHandler implements RequestHandlerInterface
{
    private DatabaseStatusChecker $databaseStatusChecker;
    private BlogPostRepository $blogPostRepository;


    public function __construct(BlogPostRepository $blogPostRepository, DatabaseStatusChecker $databaseStatusChecker)
    {
        $this->blogPostRepository = $blogPostRepository;
        $this->databaseStatusChecker = $databaseStatusChecker;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $isDatabaseConnected = $this->databaseStatusChecker->isDatabaseConnected();

        if (!$isDatabaseConnected) {
            $postData = $request->getParsedBody();

            $newPost = $this->blogPostRepository->createBlogPost($postData);

            return new JsonResponse([
                'message' => 'Post created successfully',
                'data' => $newPost,
            ], 201);
        } else {
            return new JsonResponse([
                'message' => 'Database is not connected',
            ], 500);
        }
    }
}
