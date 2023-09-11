<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Mezzio\Template\TemplateRendererInterface;

class BlogPostHandlerFactory
{
    public function __invoke(ContainerInterface $container): BlogPostHandler
    {
        return new BlogPostHandler(
            new BlogPostRepository(
                $container->get(EntityManagerInterface::class)
            )
        );
    }
}
