<?php

namespace App\Model\Repositories;

class UserRepository extends BaseRepository
{
	protected $name = "users";
	/**
	 * @var UserRepository
	 */
	private $userRepository;

	/**
	 * UserService constructor.
	 *@param UserRepository $userRepository
	 */
	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function getUser($username)
	{
		return $this->getTable()->get($username)->fetch();
	}
	
}
