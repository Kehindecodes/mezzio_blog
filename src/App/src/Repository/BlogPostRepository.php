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
        $posts = $this->findAll();
        $postsArray = [];

        foreach ($posts as $post) {
            $postsArray[] = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'content' => $post->getContent(),
                'image' => $post->getImage(),
                'category' => $post->getCategory(),
            ];
        }
        return $postsArray;
    }

    // display post by id
    public function getBlogPost($id)
    {
        $post = $this->find($id);
        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'image' => $post->getImage(),
            'category' => $post->getCategory(),
        ];
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

        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'image' => $post->getImage(),
            'category' => $post->getCategory(),
        ];
    }
}
