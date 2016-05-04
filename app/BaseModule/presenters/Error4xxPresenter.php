<?php

namespace App\BaseModule\Presenters;

use Nette;

/**
 * Stará se o výpis 4xx errorů
 *
 * @package App\BaseModule\Presenters
 */
class Error4xxPresenter extends Nette\Application\UI\Presenter
{
	public function startup()
	{
		parent::startup();
		if (!$this->getRequest()->isMethod(Nette\Application\Request::FORWARD)) {
			$this->error();
		}
	}

	/**
	 * Zjistí číslo erroru a vypíše ho pomocí speciální šablony pro daný error.
	 *
	 * @param Nette\Application\BadRequestException $exception
	 */
	public function renderDefault(Nette\Application\BadRequestException $exception)
	{
		// load template 403.latte or 404.latte or ... 4xx.latte
		$file = __DIR__ . "\../templates/Error/{$exception->getCode()}.latte";
		$this->template->setFile(is_file($file) ? $file : __DIR__ . '\../templates/Error/4xx.latte');
	}
}
