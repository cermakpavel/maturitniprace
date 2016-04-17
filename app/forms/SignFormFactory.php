<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

/**
 * Obstarává přihlašovací formulář.
 *
 * @package App\Forms
 */
class SignFormFactory extends Nette\Object
{
	/** @var FormFactory */
	private $factory;

	/** @var User */
	private $user;

	/**
	 * SignFormFactory constructor.
	 *
	 * @param FormFactory $factory
	 * @param User $user
	 */
	public function __construct(FormFactory $factory, User $user)
	{
		$this->factory = $factory;
		$this->user = $user;
	}

	/**
	 * Vytvoří formulář pro přihlašování, při jeho úspěném vyplnění předá hodnoty funkci formSucceeded.
	 *
	 * @return Form
	 */
	public function create()
	{
		$form = $this->factory->create();
		$form->addText('username', 'Login:')
			->setRequired('Prosím zadej přihlašovací jméno.')
			->getControlPrototype()->class('form-control');
		$form->addPassword('password', 'Heslo:')
			->setRequired('Prosím zadej heslo.')
			->getControlPrototype()->class('form-control');
		$form->addCheckbox('remember', ' Zůstat přihlášen');
		$form->addSubmit('send', 'Přihlaš se')
			->getControlPrototype()->class('btn btn-primary');
		$form->onSuccess[] = [$this, 'formSucceeded'];
		return $form;
	}

	/**
	 * Ověří zda je login a heslo správné, pokud ano uživatele přihlásí.
	 *
	 * @param Form $form
	 * @param $values
	 */
	public function formSucceeded(Form $form, $values)
	{
		if ($values->remember) {
			$this->user->setExpiration('14 days', FALSE);
		} else {
			$this->user->setExpiration('20 minutes', TRUE);
		}
		try {
			$this->user->login($values->username, $values->password);
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError('The username or password you entered is incorrect.');
		}
	}
}
