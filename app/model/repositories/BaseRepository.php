<?php
/**
 * Created by PhpStorm.
 * User: pajos
 * Date: 08.04.2016
 * Time: 15:59
 */

namespace App\Model\Repositories;

use Nette\Database\Context;

abstract class BaseRepository
{
    /**
     * @var Context
     */
    protected $context;
    protected $name;

    /**
     * BaseRepository constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function getTable()
    {
        return $this->context->table($this->name);
    }

}
