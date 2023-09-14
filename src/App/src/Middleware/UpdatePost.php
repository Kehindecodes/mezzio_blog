<?php

declare(strict_types=1);

namespace App\Middleware;

use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use App\Repository\BlogPostRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UpdatePost implements MiddlewareInterface
{

    public function __construct(private BlogPostRepository $blogRepository, private Cloudinary $cloudinary)
    {
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $postId = $request->getAttribute('id');
        $postData = $request->getParsedBody();

        //  get upload image
        $upload = $request->getUploadedFiles();


        //    check  if a  file was uploaded
        if (isset($upload['image'])) {
            //  get image from request
            $uploadImg = $upload['image'];

            // get image path
            $filePath = $uploadImg->getStream()->getMetadata('uri');

            // get configuration from cloudinary
            $config = $this->cloudinary->configuration;

            //   upload image to cloudinary
            $uploadApi  = new UploadApi($config);

            // $cloudinary = $uploadApi->getCloud();
            $image = $uploadApi->upload($filePath, ['public_id' => $uploadImg->getClientFilename()]);
            // Add image path to post data   
            $postData['image'] = $image['secure_url'];
        }


        $updatedPost = $this->blogRepository->updateBlogPost($postId, $postData);
        if (!$updatedPost) {
            // Handle the case where no post with the given ID was found
            return new JsonResponse(['message' => 'Post not found'], 404);
        }

        return new JsonResponse([
            'message' => 'post update successfully',
            'data' => $updatedPost,
        ]);
    }
}
