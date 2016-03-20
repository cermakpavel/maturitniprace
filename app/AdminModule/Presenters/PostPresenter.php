<?php
namespace App\AdminModule\Presenters;

use Nette,
    Nette\Application\UI\Form;


class PostPresenter extends \App\BaseModule\Presenters\BasePresenter
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

    public function actionEdit($postId)
    {
        $this->template->page = $this->database->table('setting')
            ->where('id = 1');
        $post = $this->database->table('posts')->get($postId);
        if (!$post) {
            $this->error('Příspěvek nebyl nalezen');
        }
        $this['postForm']->setDefaults($post->toArray());
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

    protected function createComponentPostForm()
    {
        $form = new Form;
        $form->addText('title', 'Titulek:')
            ->setRequired();

        $form->addTextArea('content', 'Obsah:')
            ->setRequired();

        $form->addSubmit('send', 'Uložit a publikovat');
        $form->onSuccess[] = array($this, 'postFormSucceeded');

        return $form;
    }

    public function postFormSucceeded($form, $values)
    {
        $this->template->page = $this->database->table('setting')
            ->where('id = 1');
        $postId = $this->getParameter('postId');

        if ($postId) {
            $post = $this->database->table('posts')->get($postId);
            $post->update($values);
        } else {
            $post = $this->database->table('posts')->insert($values);
        }

        $this->flashMessage('Příspěvek byl úspěšně publikován.', 'success');
        $this->redirect('Dashboard:');
    }
}