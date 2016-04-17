<?php

namespace App\Model\Repositories;

use Nette\Database\Context;

/**
 * Repository z kterého dědí ostatní repository.
 *
 * @package App\Model\Repositories
 */
abstract class BaseRepository
{
	/**
	 * @var Context
	 */
	protected $context;

	protected $name;

	/**
	 * BaseRepository constructor.
	 *
	 * @param Context $context
	 */
	public function __construct(Context $context)
	{
		$this->context = $context;
	}

	/**
	 * SQL příkaz pro zvolení tabulky v databázi.
	 *
	 * @return \Nette\Database\Table\Selection
	 */
	public function getTable()
	{
		return $this->context->table($this->name);
	}
}
