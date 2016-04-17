<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;

/**
 * FormFactory se stará o generování formulářů.
 *
 * @package App\Forms
 */
class FormFactory extends Nette\Object
{
	/**
	 * @return Form
	 */
	public function create()
	{
		return new Form;
	}
}
