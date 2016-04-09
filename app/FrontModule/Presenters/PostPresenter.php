<?php
namespace App\FrontModule\Presenters;

use App\Model\Services\PostService;
use App\Model\Services\SettingService;
use Nette;
use Nette\Application\UI\Form;


class PostPresenter extends \App\BaseModule\Presenters\BasePresenter
{
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

    public function renderShow($postId)
    {
        $post = $this->postService->getPostById($postId);
        $posts = $this->postService->getAllPosts();
        if (!$post or !$posts) {
            $this->error('Stránka nebyla nalezena');
        }
        $posts = $this->postService->getAllPosts();
        $setting = $this->settingService->getSetting();
        $this->template->post = $post;
        $this->template->posts = $posts;
        $this->template->setting = $setting;
    }

    protected function createComponentCommentForm()
    {
        $form = new Form;

        $form->addText('name', 'Jméno:')
            ->setRequired();

        $form->addText('email', 'Email:')
            ->setRequired();

        $form->addTextArea('content', 'Komentář:')
            ->setRequired();

        $form->addSubmit('send', 'Odeslat komentář');

        $form->onSuccess[] = array($this, 'commentFormSucceeded');

        return $form;
    }
}
