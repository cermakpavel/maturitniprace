<?php
namespace App\AdminModule\Presenters;

use App\Model\Services\PostService;
use App\Model\Services\SettingService;
use Nette;
use Nette\Application\UI\Form;

/**
 * Presenter, který se stará o přidání, editaci a smazaní stránky.
 *
 * @package App\AdminModule\Presenters
 */
class PostPresenter extends \App\BaseModule\Presenters\BasePresenter
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
	 * Zajišťujě editaci stránky.
	 *
	 * @param $postId
	 * @throws Nette\Application\BadRequestException
	 */
	public function actionEdit($postId)
	{
		$post = $this->postService->getPostById($postId);
		$this->template->post = $post;
		if (!$post) {
			$this->error('Příspěvek nebyl nalezen');
		}
		$this['postForm']->setDefaults($post->toArray());
	}

	/**
	 * Zajišťuje smazání stránky.
	 *
	 * @param $postId
	 */
	public function actionDelete($postId)
	{
		$this->postService->deletePost($postId);

		$this->flashMessage('Stránka byla smazána.', 'info');
		$this->redirect('Dashboard:');
	}

	/**
	 * Vytvoří formulář a při úspěšném vyplnění formuláře a jeho odeslání předá hodnoty funkci postFormSucceeded.
	 *
	 * @return Form
	 */
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

	/**
	 * Získaná data z formuláře uloží do databáze.
	 *
	 * @param $form
	 * @param $values
	 */
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
