<?php

namespace App\AdminModule\Presenters;

use Nette;
use App\Model;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;


class DashboardPresenter extends \App\BaseModule\Presenters\BasePresenter
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

	public function renderDefault()
	{
		$posts = $this->postService->getAllPosts();
		$setting = $this->settingService->getSetting();
		$this->template->posts = $posts;
		$this->template->setting = $setting;
	}

}
