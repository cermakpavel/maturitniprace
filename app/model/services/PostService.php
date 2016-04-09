<?php

namespace App\Model\Services;


use App\Model\Repositories\PostRepository;

class PostService
{
    /**
     * @var PostService
     */
    private $postRepository;

    /**
     * PostService constructor.
     *
     *@param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getPostById($id)
    {
        return $this->postRepository->getPostById($id);
    }

    public function getFirstPost()
    {
        return $this->getAllPosts()->fetch();
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }

	public function insertPost($values)
	{
		$this->insertPost($values);
	}

	public function deletePost($postId)
    {
	    return $this->deletePost($postId);
    }


}
