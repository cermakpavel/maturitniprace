<?php
namespace App\AdminModule\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;


class PostPresenter extends \App\BaseModule\Presenters\BasePresenter
{

    protected function startup() {
        parent::startup();

        if (!$this->user->isLoggedIn()) {
            $this->redirect(':Admin:Sign:in');
        }
    }

    private $postService;
    private $settingService;

    public function injectPost(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function injectSetting(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function actionEdit($postId)
    {
        $post = $this->postService->getPostById($postId);
        $setting = $this->settingService->getSetting();
        $this->template->post = $post;
        $this->template->page = $setting;
        if (!$post) {
            $this->error('Příspěvek nebyl nalezen');
        }
        $this['postForm']->setDefaults($post->toArray());
    }

    public function actionDelete($postId) {
        $post = $this->postService->getPostById($postId);
        $post->delete($postId);

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
        $postId = $this->getParameter('postId');

        if ($postId) {
            $post = $this->postService->getPostById($postId);
            $post->update($values);
        } else {
            $post = $this->postService->getAllPosts();
            $post->insert($values);
        }

        $this->flashMessage('Příspěvek byl úspěšně publikován.', 'success');
        $this->redirect('Dashboard:');
    }
}
