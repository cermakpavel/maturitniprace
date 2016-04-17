<?php
/**
 * Created by PhpStorm.
 * User: pajos
 * Date: 08.04.2016
 * Time: 17:34
 */

namespace App\Model\Services;

use App\Model\Repositories\SettingRepository;

/**
 * Obstarává propojení s presenterem a SettingRepository
 *
 * @package App\Model\Services
 */
class SettingService
{
	/**
	 * @var SettingRepository
	 */
	private $settingRepository;

	/**
	 * SettingService constructor.
	 *
	 * @param SettingRepository $settingRepository
	 */
	public function __construct(SettingRepository $settingRepository)
	{
		$this->settingRepository = $settingRepository;
	}

	/**
	 * Získá nastavení stránky.
	 *
	 * @return bool|\Nette\Database\Table\IRow
	 */
	public function getSetting()
	{
		return $this->settingRepository->getSetting(1);
	}

	/**
	 * Upraví nastavení stránky.
	 *
	 * @param $values
	 */
	public function updateSetting($values)
	{
		$this->settingRepository->updateSetting($values);
	}
}
