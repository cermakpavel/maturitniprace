<?php

namespace App\Model\Services;

use App\Model\Repositories\UserRepository;

class UserService
{
	/**
	 * @var UserService
	 */
	private $userRepository;

	/**
	 * UserService constructor.
	 *
	 *@param UserRepository $userRepository
	 */
	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function getUser($username)
	{
		return $this->userRepository->getUser($username);
	}

}
