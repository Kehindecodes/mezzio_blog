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

    // update post

    public function updateBlogPost($id, array $data)
    {
        $post = $this->find($id);

        if (!$post) {
            // Handle the case where no post with the given ID was found
            return null;
        }

        if (isset($data['title'])) {
            $post->setTitle($data['title']);
        }
        if (isset($data['content'])) {
            $post->setContent($data['content']);
        }
        if (isset($data['image'])) {
            $post->setImage($data['image']);
        }
        if (isset($data['category'])) {
            $post->setCategory($data['category']);
        }

        $this->entityManager->flush();

        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'image' => $post->getImage(),
            'category' => $post->getCategory(),
        ];
    }


    public function removePost($id)
    {
        $post = $this->find($id);

        // delete post
        $this->entityManager->remove($post);
        $this->entityManager->flush();

        return true;
    }
}
