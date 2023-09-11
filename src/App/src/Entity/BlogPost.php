<?php

namespace  App\Entity;



use Doctrine\ORM\Mapping as ORM;

use App\Repository\BlogPostRepository;
use Doctrine\DBAL\Types\Types;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 * @ORM\Table(name="posts")
 */

#[ORM\Table(name: "posts")]
#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
class  BlogPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    /**
     * @ORM\Column(type="string")
     */
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

    /**
     * @ORM\Column(type="string")
     */
    #[ORM\Column(type: Types::STRING)]
    private $category;


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

    public  function setCategory($category)
    {
        $this->category = $category;
    }
}
