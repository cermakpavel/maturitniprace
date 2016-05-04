<?php

namespace App\FrontModule\Presenters;

use App\Model;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;
use Nette;

/**
 * Stará se o one-page zobrazení stránky.
 *
 * @package App\FrontModule\Presenters
 */
class HomepagePresenter extends \App\BaseModule\Presenters\BasePresenter
{
	private $postService;

	private $settingService;

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
	 * Při spuštění presenteru ověří, zda je nastaven one-page zobrazení.
	 * Pokud není, přesměruje uživatele na multi-page zobrazení.
	 */
	protected function startup()
	{
		parent::startup();

		$setting = $this->settingService->getSetting();
		if (!$setting->onepage_layout) {
			$this->redirect('Post:show', $this->postService->getFirstPost()->id);
		}

	}

	/**
	 * Získá data a předá je šabloně.
	 */
	public function renderDefault()
	{
		$posts = $this->postService->getAllPosts();
		if ($posts == FALSE) {
			$this->redirect('Base:Error:');
		}
		$setting = $this->settingService->getSetting();
		$this->template->posts = $posts;
		$this->template->setting = $setting;
	}
}
