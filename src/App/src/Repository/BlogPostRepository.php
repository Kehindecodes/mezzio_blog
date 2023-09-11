<?php

namespace App\Repository;


use App\Entity\BlogPost;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class BlogPostRepository extends EntityRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(BlogPost::class));
    }

    // display all posts
    public function getBlogPosts()
    {
        return $this->findAll();
    }

    // display post by id
    public function getBlogPost($id)
    {
        return $this->find($id);
    }

    // create new post
    public function createBlogPost(array $data)
    {
        $post = new BlogPost();
        $post->setTitle($data['title']);
        $post->setContent($data['content']);
        $post->setImage($data['image']);
        $post->setCategory($data['category']);

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $post;
    }
}
