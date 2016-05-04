<?php

namespace App\AdminModule\Presenters;

use App\Model\Services\CommentService;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;

/**
 * Presenter, který se stará o vypsání všech komentářů
 *
 * @package App\AdminModule\Presenters
 */
class CommentsPresenter extends \App\BaseModule\Presenters\BasePresenter
{
	private $postService;

	private $settingService;

	private $commentService;

	/**
	 * Inject PostService
	 *
	 * @param PostService $postService
	 */
	public function injectPost(PostService $postService)
	{
		$this->postService = $postService;
	}

	/**
	 * Inject SettingService
	 *
	 * @param SettingService $settingService
	 */
	public function injectSetting(SettingService $settingService)
	{
		$this->settingService = $settingService;
	}

	/**
	 * Inject CommentService
	 *
	 * @param CommentService $commentService
	 */
	public function injectComment(CommentService $commentService)
	{
		$this->commentService = $commentService;
	}

	/**
	 * Při spuštění presenteru ověří, zda je uživatel přihlášen.
	 */
	protected function startup()
	{
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$this->redirect(':Admin:Sign:in');
		}
	}

	/**
	 * Získá data a předá je šabloně k vykreslení.
	 */
	public function renderDefault()
	{
		$posts = $this->postService->getAllPosts();
		$setting = $this->settingService->getSetting();
		$comments = $this->commentService->getAllComments();
		$this->template->comments = $comments;
		$this->template->posts = $posts;
		$this->template->setting = $setting;
	}

	/**
	 * Smaže komentář.
	 *
	 * @param $commentId
	 */
	public function actionDeleteComment($commentId)
	{
		$this->commentService->deleteComment($commentId);
		$this->redirect('Comments:');
	}
}
