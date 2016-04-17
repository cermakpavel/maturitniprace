<?php

namespace App\Model\Services;

use App\Model\Repositories\CommentRepository;

/**
 * Obstarává propojení presenteru a comment repository.
 *
 * @package App\Model\Services
 */
class CommentService
{
	/**
	 * @var CommentRepository
	 */
	private $commentRepository;

	/**
	 * CommentService constructor.
	 *
	 * @param CommentRepository $commentRepository
	 */
	public function __construct(CommentRepository $commentRepository)
	{
		$this->commentRepository = $commentRepository;
	}

	/**
	 * Z comment repository získá komentáře k dané stránce.
	 *
	 * @param $postId
	 * @return static
	 */
	public function getCommentsByPost($postId)
	{
		return $this->commentRepository->getCommentsByPost($postId);
	}

	/**
	 * Získá všechny komentáře.
	 *
	 * @return static
	 */
	public function getAllComments()
	{
		return $this->commentRepository->getAllComments();
	}

	/**
	 * Získá všechny komentáře, které ještě nebyly schváleny.
	 *
	 * @return static
	 */
	public function getCommentsForApprove()
	{
		return $this->commentRepository->getCommentsForApprove();
	}

	/**
	 * Vloží komentář k dané stránce.
	 *
	 * @param $postId
	 * @param $values
	 */
	public function insertComment($postId, $values)
	{
		$this->commentRepository->insertComment($postId, $values);
	}

	/**
	 * Schválí komentář.
	 *
	 * @param $commentId
	 */
	public function approveComment($commentId)
	{
		$this->commentRepository->approveComment($commentId);
	}

	/**
	 * Smaže komentář.
	 *
	 * @param $commentId
	 */
	public function deleteComment($commentId)
	{
		$this->commentRepository->deleteComment($commentId);
	}
}
