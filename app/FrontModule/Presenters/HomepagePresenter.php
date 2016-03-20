<?php

namespace App\FrontModule\Presenters;

use Nette;
use App\Model;


class HomepagePresenter extends \App\BaseModule\Presenters\BasePresenter
{
	/** @var Nette\Database\Context */
	private $database;

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	protected function startup() {
		parent::startup();

		$settings = $this->database->table('setting')
			->where('id = 1');
		foreach ($settings as $setting) {
			if ($setting->onepage == 0) {
				$posts = $this->template->posts = $this->database->table('posts')
					->order('id')
					->limit(1);
				foreach ($posts as $post) {
					$this->redirect('Post:show', $post->id);
				}
			}
		}
	}

	public function renderDefault ()
	{
		$this->template->page = $this->database->table('setting')
			->where('id = 1');
		$this->template->posts = $this->database->table('posts')
			->order('created_at DESC');
	}

}
