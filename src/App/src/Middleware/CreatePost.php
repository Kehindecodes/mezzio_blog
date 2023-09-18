<?php

declare(strict_types=1);

namespace App\Middleware;

use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use App\Repository\BlogPostRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use App\Middleware\DatabaseStatusChecker;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use GuzzleHttp\Client;



class CreatePost implements MiddlewareInterface
{

    public function __construct(private BlogPostRepository $blogPostRepository, private Cloudinary $cloudinary)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $postData = $request->getParsedBody();

        $uploadedImage = $request->getAttributes(UploadFile::class);

        $postData['image'] = $uploadedImage;

        var_dump($uploadedImage);



        if ($postData['title'] == '' || $postData['content'] == '') {
            return new JsonResponse([
                'message' => 'Please fill all the fields',
            ], 400);
        }


        $existingPost = $this->blogPostRepository->findOneBy(['title' => $postData['title']]);
        if ($existingPost) {
            $title = $existingPost->getTitle();
            if ($postData['title'] == $title) {
                return new JsonResponse([
                    'message' => 'This title already exists try another one',
                ], 400);
            }
        }




        $newPost = $this->blogPostRepository->createBlogPost($postData);

        return new JsonResponse([
            'message' => 'Post created successfully',
            'data' => $newPost,
        ], 201);
    }
}
