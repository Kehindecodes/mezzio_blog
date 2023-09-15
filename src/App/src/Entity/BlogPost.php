<?php

namespace  App\Entity;



use Doctrine\ORM\Mapping as ORM;

use App\Repository\BlogPostRepository;
use Doctrine\DBAL\Types\Types;



#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
#[ORM\Table(name: "posts")]

class  BlogPost
{

    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::STRING)]
    private $title;

    /**
     * @ORM\Column(type="longtext")
     */
    #[ORM\Column(type: Types::TEXT)]
    private $content;

    /**
     * @ORM\Column(type="image")
     */
    #[ORM\Column(type: Types::STRING)]
    private $image;


    #[ORM\Column(type: Types::STRING)]
    private $category;


    // return properties

    public function getProperties()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'category' => $this->category,

        ];
    }


    public  function getId(): int
    {
        return $this->id;
    }

    public  function setTitle($title)
    {
        $this->title = $title;
    }

    public  function setContent($content)
    {
        $this->content = $content;
    }

    public  function setImage($image)
    {
        $this->image = $image;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function getImage(): string
    {
        return $this->image;
    }
    public function getCategory(): string
    {
        return $this->category;
    }
    public function getContent(): string
    {
        return $this->content;
    }
}
