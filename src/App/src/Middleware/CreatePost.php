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

        //  get upload image
        $upload = $request->getUploadedFiles();


        //    check  if a  file was uploaded
        if (isset($upload['image'])) {
            //  get image from request
            $uploadImg = $upload['image'];

            // get image path
            $filePath = $uploadImg->getStream()->getMetadata('uri');

            //    set up cloudinary
            // $cloudinary = new Cloudinary($this->cloudinary);

            // get configuration from cloudinary
            $config = $this->cloudinary->configuration;

            //   upload image to cloudinary
            $uploadApi  = new UploadApi($config);

            // $cloudinary = $uploadApi->getCloud();
            $image = $uploadApi->upload($filePath, ['public_id' => $uploadImg->getClientFilename()]);
            // Add image path to post data

            $postData['image'] = $image['secure_url'];
        }


        if ($postData['title'] == '' || $postData['content'] == '') {
            return new JsonResponse([
                'message' => 'Please fill all the fields',
            ], 400);
        }

        $existingPost = $this->blogPostRepository->findOneBy(['title' => $postData['title']]);
        $title = $existingPost->getTitle();

        if ($postData['title'] == $title) {
            return new JsonResponse([
                'message' => 'This title already exists try another one',
            ], 400);
        }

        $newPost = $this->blogPostRepository->createBlogPost($postData);

        return new JsonResponse([
            'message' => 'Post created successfully',
            'data' => $newPost,
        ], 201);
    }
}
