<?php
/**
 * Created by PhpStorm.
 * User: pajos
 * Date: 08.04.2016
 * Time: 15:47
 */

namespace App\Model\Repositories;


class PostRepository extends BaseRepository
{
    protected $name = "posts";

    public function getPostById($id)
    {
        return $this->getTable()->get($id);

    }

    public function getAllPosts()
    {
        return $this->getTable()->order('created_at DESC');
    }

}