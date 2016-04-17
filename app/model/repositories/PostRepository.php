<?php

namespace App\Model\Repositories;

class PostRepository extends BaseRepository
{
	protected $name = "posts";

	public function getPostById($id)
	{
		return $this->getTable()->get($id);

	}

	public function getAllPosts()
	{
		return $this->getTable()->order('created_at DESC');
	}

	public function insertPost($values)
	{
		$this->getTable()->insert($values);
	}

	public function updatePost($postId, $values)
	{
		$this->getTable()->where('id', $postId)->update($values);
	}

	public function deletePost($postId)
	{
		$this->getTable()->where('id', $postId)->delete();
	}
}
