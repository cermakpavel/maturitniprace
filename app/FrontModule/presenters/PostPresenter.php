<?php
namespace App\FrontModule\Presenters;

use App\Model\Services\CommentService;
use App\Model\Services\PostService;
use App\Model\Services\SettingService;
use Nette;
use Nette\Application\UI\Form;

/**
 * Stará se o zobrazení jednotlivé stránky, vypsání komentářů k dané stránce a přidání komentáře k dané stránce.
 *
 * @package App\FrontModule\Presenters
 */
class PostPresenter extends \App\BaseModule\Presenters\BasePresenter
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
	 * @param SettingService $settingService
	 */
	public function injectSetting(SettingService $settingService)
	{
		$this->settingService = $settingService;
	}

	/**
	 * Inject CommentService
	 * @param CommentService $commentService
	 */
	public function injectComment(CommentService $commentService)
	{
		$this->commentService = $commentService;
	}

	/**
	 * Při spuštění presenteru ověř, jestli je nastaveno multi-page zobrazení.
	 * Pokud ne, přesměruj na one-page zobrazení.
	 */
	protected function startup()
	{
		parent::startup();

		$setting = $this->settingService->getSetting();
		if ($setting->onepage_layout) {
			$this->redirect('Homepage:');
		}

	}

	/**
	 * Získá obsah dané stránky, její komentáře a předá je šabloně.
	 * @param $postId
	 */
	public function renderShow($postId)
	{
		$post = $this->postService->getPostById($postId);
		$posts = $this->postService->getAllPosts();
		if ($post == FALSE) {
			$this->redirect('Base:Error:');
		}
		if ($posts == FALSE) {
			$this->redirect('Base:Error:');
		}
		$setting = $this->settingService->getSetting();
		$comments = $this->commentService->getCommentsByPost($postId);
		$this->template->post = $post;
		$this->template->posts = $posts;
		$this->template->setting = $setting;
		$this->template->comments = $comments;
	}

	/**
	 * Zajišťuje vypsání formuláře pro přidání komentáře.
	 * @return Form
	 */
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

	/**
	 * Pokud je formulář správně vyplněn, vezme jeho data a uloží je do databáze.
	 * @param $form
	 * @param $values
	 */
	public function commentFormSucceeded($form, $values)
	{
		$postId = $this->getParameter('postId');

		$this->commentService->insertComment($postId, $values);

		$this->flashMessage('Komentář byl úspěšně publikován.', 'success');
		$this->redirect('this');
	}
}
