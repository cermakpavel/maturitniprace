<?php
namespace App\AdminModule\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\Services\SettingService;


class SettingPresenter extends \App\BaseModule\Presenters\BasePresenter
{
    private $settingService;

    public function injectSetting(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    protected function startup() {
        parent::startup();

        if ($this->user->isLoggedIn() != TRUE) {
            $this->redirect(':Admin:Sign:in');
        }
    }

    public function actionEdit()
    {
        $setting = $this->settingService->getSetting();
        $this['settingForm']->setDefaults($setting->toArray());
    }

    protected function createComponentSettingForm()
    {
        $form = new Form;
        $template = array('Multipage','Onepage');
        $form->addText('title', 'Název stránky:')
            ->getControlPrototype()->class('form-control')
            ->setRequired();
        $form->addTextArea('subtitle', 'Podtitulek stránky:')
            ->setRequired();
        $form->addSelect('onepage_layout', 'Zvolte druh šablony:', $template);

        $form->addSubmit('send', 'Uložit nastavení');
        $form->onSuccess[] = array($this, 'settingFormSucceeded');

        return $form;
    }

    public function settingFormSucceeded($form, $values)
    {
        $setting = $this->settingService->getSetting();
        $setting->update($values);

        $this->flashMessage('Nastavení bylo úspěšně uloženo.', 'success');
        $this->redirect('Dashboard:');
    }
}
