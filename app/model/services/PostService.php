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

	public function getFirstPost()
	{
		return $this->postRepository->getAllPosts()->fetch();
	}

	public function getAllPosts()
	{
		return $this->postRepository->getAllPosts();
	}

	public function insertPost($values)
	{
		$this->postRepository->insertPost($values);
	}

	public function updatePost($postId, $values)
	{
		$this->postRepository->updatePost($postId, $values);
	}

	public function deletePost($postId)
	{
		return $this->postRepository->deletePost($postId);
	}
}
