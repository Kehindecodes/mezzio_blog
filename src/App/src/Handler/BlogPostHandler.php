<?php

declare(strict_types=1);

namespace App\Handler;

use App\Repository\BlogPostRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;

class BlogPostHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(private BlogPostRepository $repository)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(['foo' => 'bar']);
        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'app::blog-post',
            [] // parameters to pass to template
        ));
    }
}
