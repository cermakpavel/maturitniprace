<?php

namespace App\AdminModule\Presenters;

use Nette;
use App\Model;
use Nette\Security\User;


class DashboardPresenter extends \App\BaseModule\Presenters\BasePresenter
{

	protected function startup() {
		parent::startup();

		if ($this->user->isLoggedIn() != TRUE) {
			$this->redirect(':Admin:Sign:in');
		}
	}
	/** @var Nette\Database\Context */
	private $database;

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	public function renderDefault()
	{
		$this->template->page = $this->database->table('setting')
			->where('id = 1');
		//$user = $this->getUser();
		//echo 'Prihlášen uživatel: ' . $user->getIdentity()->id;
		//$username = $user->getIdentity()->username;
		$this->template->posts = $this->database->table('posts')
			->order('created_at DESC')
			->limit(5);
	}

}
