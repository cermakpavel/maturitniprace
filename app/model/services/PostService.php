<?php

namespace App\Model\Services;

use App\Model\Repositories\PostRepository;

/**
 * Obstarává propojení mezi presenterem a CommentRepository.
 *
 * @package App\Model\Services
 */
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

	/**
	 * Získá data dané stránky.
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getPostById($id)
	{
		return $this->postRepository->getPostById($id);
	}

	/**
	 * Získá první stránku v databázi.
	 *
	 * @return mixed
	 */
	public function getFirstPost()
	{
		return $this->postRepository->getAllPosts()->fetch();
	}

	/**
	 * Získá všechny stránky v databázi.
	 *
	 * @return mixed
	 */
	public function getAllPosts()
	{
		return $this->postRepository->getAllPosts();
	}

	/**
	 * Vloží stránku do databáze.
	 *
	 * @param $values
	 */
	public function insertPost($values)
	{
		$this->postRepository->insertPost($values);
	}

	/**
	 * Upraví stránku v databázi.
	 *
	 * @param $postId
	 * @param $values
	 */
	public function updatePost($postId, $values)
	{
		$this->postRepository->updatePost($postId, $values);
	}

	/**
	 * Smaže stránku v databázi.
	 *
	 * @param $postId
	 * @return mixed
	 */
	public function deletePost($postId)
	{
		return $this->postRepository->deletePost($postId);
	}
}
