<?php

namespace App\AdminModule\Presenters;

use App\Model;
use App\Model\Services\CommentService;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;

/**
 * Class DashboardPresenter - Stará se o Dashboard v administraci
 *
 * @package App\AdminModule\Presenters
 */
class DashboardPresenter extends \App\BaseModule\Presenters\BasePresenter
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
		$comments = $this->commentService->getCommentsForApprove();
		$this->template->comments = $comments;
		$this->template->posts = $posts;
		$this->template->setting = $setting;
	}

	public function actionApproveComment($commentId)
	{
		$this->commentService->approveComment($commentId);
		$this->redirect('Dashboard:');
	}

	public function actionDeleteComment($commentId)
	{
		$this->commentService->deleteComment($commentId);
		$this->redirect('Dashboard:');
	}

	protected function startup()
	{
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$this->redirect(':Admin:Sign:in');
		}
	}

}
