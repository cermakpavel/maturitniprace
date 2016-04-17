<?php

namespace App\Model\Repositories;

/**
 * Obstarává dotazy do databáze týkající se nastavení stránky.
 *
 * @package App\Model\Repositories
 */
class SettingRepository extends BaseRepository
{
	/**
	 * Nastavení proměné $name, která udává do jaké tabulky vykonávat příkazy.
	 */
	protected $name = "setting";

	/**
	 * Získá aktuální nastavení.
	 *
	 * @return bool|\Nette\Database\Table\IRow
	 */
	public function getSetting()
	{
		return $this->getTable()->fetch();
	}

	/**
	 * Upraví aktuální nastavení.
	 *
	 * @param $values
	 */
	public function updateSetting($values)
	{
		$this->getTable()->where('id', 1)->update($values);
	}
}
