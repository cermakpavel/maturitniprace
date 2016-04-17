<?php

namespace App\Model\Repositories;


class SettingRepository extends BaseRepository
{
    protected $name = "setting";

    public function getSetting()
    {
        return $this->getTable()->fetch();
    }

    public function updateSetting($values)
    {
        $this->getTable()->where('id', 1)->update($values);
    }
}
