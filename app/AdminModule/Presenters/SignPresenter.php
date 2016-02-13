<?php

namespace App\AdminModule\Presenters;

use Nette;
use App\Forms\SignFormFactory;


class SignPresenter extends \App\BaseModule\Presenters\BasePresenter
{
	/** @var SignFormFactory @inject */
	public $factory;

    /**
     * Pokud je uživatel přihlášený, přesměrujeme ho rovnou do administrace.
     */
    protected function startup() {
        parent::startup();

        if ($this->user->isLoggedIn() == TRUE && $this->getAction() != "out") {
            $this->redirect(':Admin:Dashboard:');
        }
    }

	/**
	 * Vytvoříme přihlašovací formulář a po úspěšném přihlášení uživatele přesměrujeme do administrace.
	 */
	protected function createComponentSignInForm()
	{
		$user = $this->getUser();
		if ($user->isLoggedIn()) {
            $this->redirect("Dashboard:");
		}
		else {
			$form = $this->factory->create();
			$form->onSuccess[] = function ($form) {
				$form->getPresenter()->redirect('Dashboard:');
			};
            return $form;
		}
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
