<?php

namespace App\FrontModule\Presenters;

use Nette;
use App\Model;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;


class HomepagePresenter extends \App\BaseModule\Presenters\BasePresenter
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
	
	protected function startup() {
		parent::startup();

		$setting = $this->settingService->getSetting();
		if (!$setting->onepage_layout) {
			$this->redirect('Post:show', $this->postService->getFirstPost()->id);
		}

	}

	public function renderDefault ()
	{
		$posts = $this->postService->getAllPosts();
		$setting = $this->settingService->getSetting();
		$this->template->posts = $posts;
		$this->template->setting = $setting;
	}

}
