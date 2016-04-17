<?php

namespace App\BaseModule\Presenters;

use Nette;
use Nette\Application\Responses;
use Nette\SmartObject;
use Tracy\ILogger;

class ErrorPresenter implements Nette\Application\IPresenter
{
	/** @var ILogger */
	private $logger;

	public function __construct(ILogger $logger)
	{
		$this->logger = $logger;
	}

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
