<?php

namespace App\AdminModule\Presenters;

use App\Model;
use App\Model\Services\CommentService;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;

/**
 * Presenter, který se stará o hlavní stránku v administraci.
 *
 * @package App\AdminModule\Presenters
 */
class DashboardPresenter extends \App\BaseModule\Presenters\BasePresenter
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
	 * Při spuštění presenteru ověří, zda je uživatel přihlášen a načte nastavení stránky.
	 */
	protected function startup()
	{
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$this->redirect(':Admin:Sign:in');
		}

		$setting = $this->settingService->getSetting();
		$this->template->setting = $setting;
	}

	/**
	 * Získá data a předá je šabloně k vykreslení.
	 */
	public function renderDefault()
	{
		$posts = $this->postService->getAllPosts();
		$comments = $this->commentService->getCommentsForApprove();
		$this->template->comments = $comments;
		$this->template->posts = $posts;
	}

	/**
	 * Schválí komentář
	 *
	 * @param $commentId
	 */
	public function actionApproveComment($commentId)
	{
		$this->commentService->approveComment($commentId);
		$this->redirect('Dashboard:');
	}

	/**
	 * Smaže komentář
	 *
	 * @param $commentId
	 */
	public function actionDeleteComment($commentId)
	{
		$this->commentService->deleteComment($commentId);
		$this->redirect('Dashboard:');
	}
}
