<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Doctrine\ORM\EntityManagerInterface;

class DatabaseStatusChecker implements MiddlewareInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $connection = $this->entityManager->getConnection();
            $connection->connect();
            return $handler->handle($request); // Forward the request to the next middleware
        } catch (\Exception $e) {
            // Handle the exception and return an appropriate response
            $response = new \Laminas\Diactoros\Response();
            $response->getBody()->write('Database connection error');
            return $response->withStatus(500);
        }
    }
}
