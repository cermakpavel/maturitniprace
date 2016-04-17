<?php

namespace App\BaseModule\Presenters;

use Nette;
use Nette\Application\Responses;
use Nette\SmartObject;
use Tracy\ILogger;

/**
 * Presenter se stará o výpis Errorů
 *
 * @package App\BaseModule\Presenters
 */
class ErrorPresenter implements Nette\Application\IPresenter
{
	/** @var ILogger */
	private $logger;

	public function __construct(ILogger $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * Pokud jde o error 4xx přesměruje na Error4xxPresenter, jinak vypíše 500
	 *
	 * @param Nette\Application\Request $request
	 * @return Responses\CallbackResponse|Responses\ForwardResponse
	 */
	public function run(Nette\Application\Request $request)
	{
		$exception = $request->getParameter('exception');

		if ($exception instanceof Nette\Application\BadRequestException) {
			return new Responses\ForwardResponse($request->setPresenterName('Base:Error4xx'));
		}

		$this->logger->log($exception, ILogger::EXCEPTION);
		return new Responses\CallbackResponse(function () {
			require __DIR__ . '\../templates/Error/500.phtml';
		});
	}
}
