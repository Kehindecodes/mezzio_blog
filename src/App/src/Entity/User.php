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
    private $userName;

    #[ORM\Column(type: Types::STRING)]
    private $password;

    #[ORM\Column(type: Types::STRING)]
    private $email;

    #[ORM\Column(type: Types::STRING)]
    private $profileImage;


    // return properties
    public function getProperties()
    {
        return [
            'id' => $this->id,
            'userName' => $this->userName,
            'password' => $this->password,
            'email' => $this->email,
            'profileImage' => $this->profileImage,
        ];
    }

    // getters and setters

    // setters

    public function setUserName(string $userName): string
    {
        return $this->userName = $userName;
    }

    public function setPassword(string $password): string
    {
        return $this->password = $password;
    }

    public function setEmail(string $email): string
    {
        return $this->email = $email;
    }

    public function setProfileImage(string $profileImage): string
    {
        return $this->profileImage = $profileImage;
    }


    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getProfileImage(): string
    {
        return $this->profileImage;
    }
}
