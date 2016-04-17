<?php

namespace App\Model\Repositories;

/**
 * Obstarává dotazy do databáze týkající se stránek.
 *
 * @package App\Model\Repositories
 */
class PostRepository extends BaseRepository
{
	/**
	 * Nastavení proměné $name, která udává do jaké tabulky vykonávat příkazy.
	 */
	protected $name = "posts";

	/**
	 * Získá obsah stránky s daným id.
	 *
	 * @param $id
	 * @return \Nette\Database\Table\IRow
	 */
	public function getPostById($id)
	{
		return $this->getTable()->get($id);

	}

	/**
	 * Získá všechny stránky v databázi.
	 *
	 * @return static
	 */
	public function getAllPosts()
	{
		return $this->getTable()->order('created_at DESC');
	}

	/**
	 * Uloží novou stránku do databáze.
	 *
	 * @param $values
	 */
	public function insertPost($values)
	{
		$this->getTable()->insert($values);
	}

	/**
	 * Upraví hodnoty stránky s daným id.
	 *
	 * @param $postId
	 * @param $values
	 */
	public function updatePost($postId, $values)
	{
		$this->getTable()->where('id', $postId)->update($values);
	}

	/**
	 * Smaže stránku s daným id.
	 *
	 * @param $postId
	 */
	public function deletePost($postId)
	{
		$this->getTable()->where('id', $postId)->delete();
	}
}
