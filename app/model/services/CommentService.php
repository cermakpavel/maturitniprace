<?php

namespace App\Model\Services;

use App\Model\Repositories\CommentRepository;

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

	public function getCommentsByPost($postId)
	{
		return $this->commentRepository->getCommentsByPost($postId);
	}

	public function getAllComments()
	{
		return $this->commentRepository->getAllComments();
	}

	public function getCommentsForApprove()
	{
		return $this->commentRepository->getCommentsForApprove();
	}

	public function approveComment($commentId)
	{
		$this->commentRepository->approveComment($commentId);
	}

	public function deleteComment($commentId)
	{
		$this->commentRepository->deleteComment($commentId);
	}

	public function insertComment($postId, $values)
	{
		$this->commentRepository->insertComment($postId, $values);
	}
}
