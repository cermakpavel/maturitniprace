<?php

namespace App\Model\Repositories;

class CommentRepository extends BaseRepository
{
	protected $name = "comments";

	public function getCommentsByPost($postId)
	{
		return $this->getTable()->where('post_id', $postId);

	}

	public function getCommentsForApprove()
	{
		$number = 0;
		return $this->getTable()->where('approved', $number)->order('created_at DESC');

	}

	public function getAllComments()
	{
		return $this->getTable()->order('post_id DESC');

	}

	public function approveComment($commentId)
	{
		$approved = ['approved' => 1];
		$this->getTable()->where('id', $commentId)->update($approved);
	}

	public function insertComment($postId, $values)
	{
		$this->getTable()->insert([
			'post_id' => $postId,
			'name' => $values->name,
			'email' => $values->email,
			'content' => $values->content,
		]);

	}

	public function deleteComment($commentId)
	{
		$this->getTable()->where('id', $commentId)->delete();
	}
}
