<?php

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UpdatePostHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = (int) $request->getAttribute('id');
        $posts = include __DIR__ . '../../../../../data/posts.php';

        // Find the post with the matching id
        $matchingPostKey = null;
        foreach ($posts as $key => $post) {
            if (isset($post['id']) && $post['id'] === $id) {
                $matchingPostKey = $key;
                break;
            }
        }

        $editedPost = $request->getParsedBody();
        $updatedPost = array_merge($posts[$matchingPostKey], $editedPost);

        // Update the matching post in the $posts array
        if ($matchingPostKey !== null) {
            $posts[$matchingPostKey] = $updatedPost;
        }

        // Update the data file
        $dataFilePath = __DIR__ . '../../../../../data/posts.php';
        file_put_contents($dataFilePath, '<?php return ' . var_export($posts, true) . ';');

        $response = new \Laminas\Diactoros\Response\JsonResponse([
            'message' => 'Post updated successfully',
            'data' => $updatedPost,
        ]);
        return $response;
    }
}
