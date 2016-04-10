<?php

namespace App\AdminModule\Presenters;

use App\Model;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;
use Nette;

/**
 * Class DashboardPresenter - Stará se o Dashboard v administraci
 *
 * @package App\AdminModule\Presenters
 */
class DashboardPresenter extends \App\BaseModule\Presenters\BasePresenter
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

	public function renderDefault()
	{
		$posts = $this->postService->getAllPosts();
		$setting = $this->settingService->getSetting();
		$this->template->posts = $posts;
		$this->template->setting = $setting;
	}

	protected function startup() {
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$this->redirect(':Admin:Sign:in');
		}
	}

}
