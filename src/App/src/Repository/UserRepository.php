<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;



class UserRepository extends EntityRepository
{
    private $qb;
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(User::class));
        $this->qb = $this->entityManager->createQueryBuilder();
    }

    // show all users
    public function getUsers()
    {
        $this->qb->select('u')
            ->from(User::class, 'u')
            ->orderBy('u.id', 'ASC');


        $users = $this->qb->getQuery()->getResult();

        if (!$users) {
            return null;
        }

        $userArray = [];

        foreach ($users as $user) {
            $userArray[] = [
                'id' => $user->getId(),
                'name' => $user->getUserName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
            ];
        }

        return $userArray;
    }
    // get a single user by id

    public function getUser($id)
    {
        $this->qb->select('u')
            ->from(User::class, 'u')
            ->where('u.id = :id');
        $this->qb->setParameter('id', $id);

        $user = $this->qb->getQuery()->getOneOrNullResult();

        if (!$user) {
            return null;
        }

        return [
            'id' => $user->getId(),
            'name' => $user->getUserName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ];
    }

    // create a new user
    public function createUser(array $data)
    {
        $user = new User();
        $user->setuserName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();


        return [
            'id' => $user->getId(),
            'name' => $user->getUserName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ];
    }
    // update a user
    public function updateUser($id, array $data)
    {
        // Check if $data array contains at least one of the expected keys
        if (!isset($data['name']) && !isset($data['email']) && !isset($data['password'])) {
            throw new \InvalidArgumentException('No fields to update specified');
        }

        $qb = $this->qb;
        $qb->update(User::class, 'u')
            ->where('u.id = :id')
            ->setParameter('id', $id);

        if (isset($data['userName'])) {
            $qb->set('u.userName', $data['userName']);
        }
        if (isset($data['email'])) {
            $qb->set('u.email', $data['email']);
        }
        if (isset($data['password'])) {
            $qb->set('u.password', $data['password']);
        }
    }
}
