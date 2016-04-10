<?php
namespace App\AdminModule\Presenters;

use App\Model\Services\SettingService;
use Nette;
use Nette\Application\UI\Form;

class SettingPresenter extends \App\BaseModule\Presenters\BasePresenter
{
    private $settingService;

    public function injectSetting(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function actionEdit()
    {
        $setting = $this->settingService->getSetting();
        $this->template->setting = $setting;
        $this['settingForm']->setDefaults($setting->toArray());
    }

    public function settingFormSucceeded($form, $values)
    {
        $setting = $this->settingService->getSetting();
        $setting->update($values);

        $this->flashMessage('Nastavení bylo úspěšně uloženo.', 'success');
        $this->redirect('Dashboard:');
    }

    protected function startup() {
        parent::startup();

        if ($this->user->isLoggedIn() != TRUE) {
            $this->redirect(':Admin:Sign:in');
        }
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
}
