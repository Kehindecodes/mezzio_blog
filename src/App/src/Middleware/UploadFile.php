<?php

declare(strict_types=1);

namespace App\Middleware;

use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UploadFile implements MiddlewareInterface
{

    public function __construct(private Cloudinary $cloudinary)
    {
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

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

            $data = $image['secure_url'];
        }

        $response = $handler->handle($request->withAttribute(self::class, $data));
        return $response;
    }
}
