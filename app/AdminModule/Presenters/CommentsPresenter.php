<?php

namespace App\AdminModule\Presenters;

use App\Model\Services\CommentService;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;

/**
 * Class CommentsPresenter - Vypisuje všechny komentáře na stránce
 *
 * @package App\AdminModule\Presenters
 */
class CommentsPresenter extends \App\BaseModule\Presenters\BasePresenter
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

	public function renderDefault()
	{
		$posts = $this->postService->getAllPosts();
		$setting = $this->settingService->getSetting();
		$comments = $this->commentService->getAllComments();
		$this->template->comments = $comments;
		$this->template->posts = $posts;
		$this->template->setting = $setting;
	}

	public function actionDeleteComment($commentId)
	{
		$this->commentService->deleteComment($commentId);
		$this->redirect('Comments:');
	}

	protected function startup()
	{
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$this->redirect(':Admin:Sign:in');
		}
	}

}
