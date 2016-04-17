<?php

namespace App\Model\Repositories;

/**
 * Získává data týkající se komentářů z tabulky comments.
 *
 * @package App\Model\Repositories
 */
class CommentRepository extends BaseRepository
{
	/**
	 * Nastavení proměné $name, která udává do jaké tabulky vykonávat příkazy.
	 */
	protected $name = "comments";

	/**
	 * Získá komentáře k dané stránce.
	 *
	 * @param $postId
	 * @return static
	 */
	public function getCommentsByPost($postId)
	{
		return $this->getTable()->where('post_id', $postId);

	}

	/**
	 * Získá komentáře, které nebyly schváleny administrátorem.
	 *
	 * @return static
	 */
	public function getCommentsForApprove()
	{
		$number = 0;
		return $this->getTable()->where('approved', $number)->order('created_at DESC');

	}

	/**
	 * Získá všechny komentáře v databázi.
	 *
	 * @return static
	 */
	public function getAllComments()
	{
		return $this->getTable()->order('post_id DESC');

	}

	/**
	 * Schválí komentář.
	 *
	 * @param $commentId
	 */
	public function approveComment($commentId)
	{
		$approved = ['approved' => 1];
		$this->getTable()->where('id', $commentId)->update($approved);
	}

	/**
	 * Vloží komentář.
	 *
	 * @param $postId
	 * @param $values
	 */
	public function insertComment($postId, $values)
	{
		$this->getTable()->insert([
			'post_id' => $postId,
			'name' => $values->name,
			'content' => $values->content,
		]);

	}

	/**
	 * Smaže komentář.
	 *
	 * @param $commentId
	 */
	public function deleteComment($commentId)
	{
		$this->getTable()->where('id', $commentId)->delete();
	}
}
