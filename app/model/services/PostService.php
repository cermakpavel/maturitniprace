<?php
/**
 * Created by PhpStorm.
 * User: pajos
 * Date: 08.04.2016
 * Time: 15:46
 */

namespace App\Model\Services;


use App\Model\Repositories\PostRepository;

class PostService
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * PostService constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getPostById($id)
    {
        return $this->postRepository->getPostById($id);
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }

    public function getFirstPost()
    {
        return $this->getAllPosts()->fetch();
    }


}
