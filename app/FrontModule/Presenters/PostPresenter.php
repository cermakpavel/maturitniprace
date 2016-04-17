<?php
namespace App\FrontModule\Presenters;

use App\Model\Services\CommentService;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;
use Nette;
use Nette\Application\UI\Form;

class PostPresenter extends \App\BaseModule\Presenters\BasePresenter
{
	private $postService;

	private $settingService;

	private $commentService;

	public function injectPost(PostService $postService)
	{
		$this->postService = $postService;
	}

	public function injectSetting(SettingService $settingService)
	{
		$this->settingService = $settingService;
	}

	public function injectComment(CommentService $commentService)
	{
		$this->commentService = $commentService;
	}

	public function renderShow($postId)
	{
		$post = $this->postService->getPostById($postId);
		$posts = $this->postService->getAllPosts();
		if (!$post or !$posts) {

			$this->redirect('Error:');
		}
		$setting = $this->settingService->getSetting();
		$comments = $this->commentService->getCommentsByPost($postId);
		$this->template->post = $post;
		$this->template->posts = $posts;
		$this->template->setting = $setting;
		$this->template->comments = $comments;
	}

	protected function startup()
	{
		parent::startup();

		$setting = $this->settingService->getSetting();
		if ($setting->onepage_layout) {
			$this->redirect('Homepage:');
		}

	}

	protected function createComponentCommentForm()
	{
		$form = new Form;

		$form->addText('name', 'Jméno:')
			->setRequired();

		$form->addTextArea('content', 'Komentář:')
			->setRequired();

		$form->addSubmit('send', 'Publikovat komentář');

		$form->onSuccess[] = [$this, 'commentFormSucceeded'];

		return $form;
	}

	public function commentFormSucceeded($form, $values)
	{
		$postId = $this->getParameter('postId');

		$this->commentService->insertComment($postId, $values);

		$this->flashMessage('Komentář byl úspěšně publikován.', 'success');
		$this->redirect('this');
	}
}
