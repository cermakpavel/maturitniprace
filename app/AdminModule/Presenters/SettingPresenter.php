<?php
namespace App\AdminModule\Presenters;

use Nette,
    Nette\Application\UI\Form;


class SettingPresenter extends \App\BaseModule\Presenters\BasePresenter
{
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    protected function startup() {
        parent::startup();

        if ($this->user->isLoggedIn() != TRUE) {
            $this->redirect(':Admin:Sign:in');
        }
    }

    public function actionEdit()
    {
        $this->template->page = $this->database->table('setting')
            ->where('id = 1');
        $post = $this->database->table('setting')->get(1);
        $this['settingForm']->setDefaults($post->toArray());
    }

    public function actionDelete($id) {
        $this->database->table('comments')
            ->where('post_id = ?', $id)
            ->delete();
        $this->database->table('posts')
            ->where('id = ?', $id)
            ->delete();
        $this->flashMessage('Stránka byla smazána.', 'info');
        $this->redirect('Dashboard:');
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
        $form->addSelect('onepage', 'Zvolte druh šablony:', $template);

        $form->addSubmit('send', 'Uložit nastavení');
        $form->onSuccess[] = array($this, 'settingFormSucceeded');

        return $form;
    }

    public function settingFormSucceeded($form, $values)
    {
        $post = $this->database->table('setting')->get(1);
        $post->update($values);
        $this->flashMessage('Nastavení bylo úspěšně uloženo.', 'success');
        $this->redirect('Dashboard:');
    }
}