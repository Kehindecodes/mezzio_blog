<?php

namespace App\Repository;


use App\Entity\BlogPost;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class BlogPostRepository extends EntityRepository
{
    private  $qb;
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(BlogPost::class));
        $this->qb = $this->entityManager->createQueryBuilder();
    }


    // display all posts
    public function getBlogPosts()
    {

        // $qb  =  $this->entityManager->createQueryBuilder();
        $this->qb->select('bp')
            ->from(BlogPost::class, 'bp')
            ->orderBy('bp.id', 'ASC');

        $posts = $this->qb->getQuery()->getResult();

        if (!$posts) {
            return null;
        }

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





        // $posts = $this->findAll();

        // if (!$posts) {
        //     return null;
        // }
        // $postsArray = [];

        // foreach ($posts as $post) {
        //     $postsArray[] = [
        //         'id' => $post->getId(),
        //         'title' => $post->getTitle(),
        //         'content' => $post->getContent(),
        //         'image' => $post->getImage(),
        //         'category' => $post->getCategory(),
        //     ];
        // }
        return $postsArray;
    }

    // display post by id
    public function getBlogPost($id)
    {

        $this->qb->select('bp')
            ->from(BlogPost::class, 'bp')
            ->where('bp.id = :id');
        $this->qb->setParameter('id', $id);

        $post = $this->qb->getQuery()->getOneOrNullResult();

        if (!$post) {
            return null;
        }

        // $post = $this->find($id);
        // if (!$post) {
        //     return null;
        // }
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

        $post->setCategory($data['category']);

        if (isset($data['image'])) {
            $post->setImage($data['image']);
        }

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
        // Check if $data array contains at least one of the expected keys
        if (!isset($data['title']) && !isset($data['content']) && !isset($data['image']) && !isset($data['category'])) {
            throw new \InvalidArgumentException('No fields to update specified');
        }

        $qb = $this->qb;

        $qb->update(BlogPost::class, 'bp')
            ->where('bp.id = :id')
            ->setParameter('id', $id);

        if (isset($data['title'])) {
            $qb->set('bp.title', ':title')
                ->setParameter('title', $data['title']);
        }

        if (isset($data['content'])) {
            $qb->set('bp.content', ':content')
                ->setParameter('content', $data['content']);
        }

        if (isset($data['image'])) {
            $qb->set('bp.image', ':image')
                ->setParameter('image', $data['image']);
        }

        if (isset($data['category'])) {
            $qb->set('bp.category', ':category')
                ->setParameter('category', $data['category']);
        }

        // Execute the update query
        $qb->getQuery()->execute();

        // Retrieve the updated BlogPost entity
        $post = $qb->getEntityManager()->getRepository(BlogPost::class)->find($id);

        if (!$post) {
            // Handle the case where no post with the given ID was found
            return null;
        }

        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'image' => $post->getImage(),
            'category' => $post->getCategory(),
        ];
    }







    // public function updateBlogPost($id, array $data)
    // {

    //     $this->qb->update(BlogPost::class, 'bp')
    //         ->set('bp.title', ':title')
    //         ->set('bp.content', ':content')
    //         ->set('bp.image', ':image')
    //         ->set('bp.category', ':category')
    //         ->where('bp.id = :id');

    //     if (isset($data['title'])) {
    //         $data['title'];
    //     }
    //     $this->qb->setParameter('id', $id);
    //     $this->qb->setParameter('title', $data['title']);
    //     $this->qb->setParameter('content', $data['content']);
    //     $this->qb->setParameter('image', $data['image']);
    //     $this->qb->setParameter('category', $data['category']);

    //     // if (isset($data['title'])) {
    //     //     $this->qb->setParameter('title', $data['title']);
    //     // }

    //     // if (isset($data['content'])) {
    //     //     $this->qb->setParameter('content', $data['content']);
    //     // }

    //     // if (isset($data['image'])) {
    //     //     $this->qb->setParameter('image', $data['image']);
    //     // }
    //     // if (isset($data['category'])) {
    //     //     $this->qb->setParameter('category', $data['category']);
    //     // }


    //     $post = $this->qb->getQuery()->getOneOrNullResult();

    //     var_dump($post);

    //     // method 1

    //     // $post = $this->find($id);

    //     // if (!$post) {
    //     //     // Handle the case where no post with the given ID was found
    //     //     return null;
    //     // }

    //     // if (isset($data['title'])) {
    //     //     $post->setTitle($data['title']);
    //     // }
    //     // if (isset($data['content'])) {
    //     //     $post->setContent($data['content']);
    //     // }
    //     // if (isset($data['image'])) {
    //     //     $post->setImage($data['image']);
    //     // }
    //     // if (isset($data['category'])) {
    //     //     $post->setCategory($data['category']);
    //     // }

    //     // $this->entityManager->flush();

    //     return [
    //         'id' => $post->getId(),
    //         'title' => $post->getTitle(),
    //         'content' => $post->getContent(),
    //         'image' => $post->getImage(),
    //         'category' => $post->getCategory(),
    //     ];
    // }


    public function removePost($id)
    {
        $this->qb->delete(BlogPost::class, 'bp')
            ->where('bp.id = :id');
        $this->qb->setParameter('id', $id);

        $result =  $this->qb->getQuery()->execute();

        if (!$result) {
            return false;
        }

        // method 2
        // $post = $this->find($id);

        // // delete post
        // $this->entityManager->remove($post);
        // $this->entityManager->flush();

        return true;
    }
}
