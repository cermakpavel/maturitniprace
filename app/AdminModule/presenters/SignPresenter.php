<?php

namespace App\AdminModule\Presenters;

use App\Forms\SignFormFactory;
use App\Model\Services\SettingService;
use Nette;

/**
 * Presenter, který obstarává přihlášení a odhlášení do administrace.
 *
 * @package App\AdminModule\Presenters
 */
class SignPresenter extends \App\BaseModule\Presenters\BasePresenter
{
	/** @var SignFormFactory @inject */
	public $factory;

	private $settingService;

	/**
	 * Inject SettingService
	 *
	 * @param SettingService $settingService
	 */
	public function injectSetting(SettingService $settingService)
	{
		$this->settingService = $settingService;
	}

	/**
	 * Při spuštění presenteru ověří, zda je uživatel přihlášen.
	 * Pokud je přihlášen automaticky ho přesměruje na hlavní stránku administrace.
	 */
	protected function startup()
	{
		parent::startup();
		if ($this->user->isLoggedIn() == TRUE && $this->getAction() != "out") {
			$this->redirect(':Admin:Dashboard:');
		}
		$setting = $this->settingService->getSetting();
		$this->template->setting = $setting;
	}

	/**
	 * Vytvoříme přihlašovací formulář a po úspěšném přihlášení uživatele přesměrujeme do administrace.
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->factory->create();
		$form->onSuccess[] = function ($form) {
			$form->getPresenter()->redirect('Dashboard:');
		};
		return $form;
	}

	/**
	 * Uživatele odhlásíme a přesměrujeme na přihlašovací okno administrace.
	 */
	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('Byl/a jste odhlášen/a.');
		$this->redirect('in');
	}
}
