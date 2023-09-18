<?php

namespace  App\Entity;



use Doctrine\ORM\Mapping as ORM;

use App\Repository\BlogPostRepository;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`users`')]

class  User
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::STRING)]
    private $username;

    #[ORM\Column(type: Types::STRING)]
    private $password;

    #[ORM\Column(type: Types::STRING)]
    private $email;



    // return properties
    public function getProperties()
    {
        return [
            'id' => $this->id,
            'userName' => $this->username,
            'password' => $this->password,
            'email' => $this->email,

        ];
    }

    // getters and setters

    // setters

    public function setUsername(string $username): string
    {
        return $this->username = $username;
    }

    public function setPassword(string $password): string
    {
        return $this->password = $password;
    }

    public function setEmail(string $email): string
    {
        return $this->email = $email;
    }

    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
