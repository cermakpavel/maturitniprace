<?php
/**
 * Created by PhpStorm.
 * User: pajos
 * Date: 08.04.2016
 * Time: 17:34
 */

namespace App\Model\Repositories;


class SettingRepository extends BaseRepository
{
    protected $name = "setting";

    public function getSetting()
    {
        return $this->getTable()->fetch();
    }
}
