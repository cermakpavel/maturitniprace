<?php
namespace App\AdminModule\Presenters;

use App\Model\Services\SettingService;
use Nette;
use Nette\Application\UI\Form;

/**
 * Zajišťuje výpis stránky Nastavení
 *
 * @package App\AdminModule\Presenters
 */
class SettingPresenter extends \App\BaseModule\Presenters\BasePresenter
{
	private $settingService;

	public function injectSetting(SettingService $settingService)
	{
		$this->settingService = $settingService;
	}

	/**
	 * Při spuštění presenteru ověř, zda je uživatel přihlášen.
	 */
	protected function startup()
	{
		parent::startup();

		if ($this->user->isLoggedIn() != TRUE) {
			$this->redirect(':Admin:Sign:in');
		}
	}

	/**
	 * Zajišťuje editaci nastavení stránky.
	 */
	public function actionEdit()
	{
		$setting = $this->settingService->getSetting();
		$this->template->setting = $setting;
		$this['settingForm']->setDefaults($setting->toArray());
	}

	/**
	 * Vytvoří formulář pro úpravu nastavení stránky + předá mu hodnoty.
	 * Po úspěšném vyplnění předá hodnoty funkci settinFormSucceeded.
	 *
	 * @return Form
	 */
	protected function createComponentSettingForm()
	{
		$form = new Form;
		$template = ['Multipage', 'Onepage'];
		$form->addText('title', 'Název stránky:')
			->getControlPrototype()->class('form-control')
			->setRequired();
		$form->addTextArea('subtitle', 'Podtitulek stránky:')
			->setRequired();
		$form->addCheckbox('comments', 'Povolit komentáře');
		$form->addSelect('onepage_layout', 'Zvolte druh šablony:', $template);

		$form->addSubmit('send', 'Uložit nastavení');
		$form->onSuccess[] = [$this, 'settingFormSucceeded'];

		return $form;
	}

	/**
	 * Převezme hodnoty z formuláře a uloží je do databáze.
	 *
	 * @param $form
	 * @param $values
	 */
	public function settingFormSucceeded($form, $values)
	{
		$this->settingService->updateSetting($values);

		$setting = $this->settingService->getSetting();
		$setting->update($values);

		$this->flashMessage('Nastavení bylo úspěšně uloženo.', 'success');
		$this->redirect('Dashboard:');
	}
}
