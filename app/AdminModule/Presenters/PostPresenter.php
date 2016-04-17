<?php
namespace App\AdminModule\Presenters;

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

	protected function startup()
	{
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$this->redirect(':Admin:Sign:in');
		}

		$setting = $this->settingService->getSetting();
		$this->template->setting = $setting;
	}

    public function actionEdit($postId)
    {
	    $post = $this->postService->getPostById($postId);
	    $this->template->post = $post;
	    if (!$post) {
            $this->error('Příspěvek nebyl nalezen');
        }
        $this['postForm']->setDefaults($post->toArray());
    }

    public function actionDelete($postId) {
	    $this->postService->deletePost($postId);

        $this->flashMessage('Stránka byla smazána.', 'info');
        $this->redirect('Dashboard:');
    }

	protected function createComponentPostForm()
	{
		$setting = $this->settingService->getSetting();
		$this->template->setting = $setting;

		$form = new Form;
		$form->addText('title', 'Titulek:')
			->setRequired();

		$form->addTextArea('content', 'Obsah:')
			->setRequired();

		$form->addSubmit('send', 'Uložit a publikovat');
		$form->onSuccess[] = [$this, 'postFormSucceeded'];

		return $form;
	}

	public function postFormSucceeded($form, $values)
    {
        $setting = $this->settingService->getSetting();
	    $this->template->setting = $setting;

	    $postId = $this->getParameter('postId');

	    if ($postId) {
		    $this->postService->getPostById($postId);
		    $this->postService->updatePost($postId, $values);
	    } else {
		    $this->postService->getAllPosts();
		    $this->postService->insertPost($values);
	    }

	    $this->flashMessage('Příspěvek byl úspěšně publikován.', 'success');
	    $this->redirect('Dashboard:');
    }

}
