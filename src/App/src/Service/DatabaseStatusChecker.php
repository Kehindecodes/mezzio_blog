<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class DatabaseStatusChecker
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function isDatabaseConnected(): bool
    {
        try {
            $connection = $this->entityManager->getConnection();
            $connection->connect();
            return $connection->isConnected();
        } catch (\Exception $e) {
            return false;
        }
    }
}
