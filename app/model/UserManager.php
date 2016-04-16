<?php
namespace App\Model;

use Nette;
use Nette\Security as NS;
use Nette\Security\Passwords;

/**
 * Users management.
 */
class UserManager extends Nette\Object implements NS\IAuthenticator
{
	const
		TABLE_NAME = 'users',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'username',
		COLUMN_PASSWORD_HASH = 'password',
		COLUMN_ROLE = 'role';

	/** @var Nette\Database\Context */
	private $database;

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	 * Performs an authentication.
	 *
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$row = $this->database->table('users')
			->where('username', $username)->fetch();
		if (!$row) {
			throw new NS\AuthenticationException('User not found.');
		}
		if (!NS\Passwords::verify($password, $row->password)) {
			throw new NS\AuthenticationException('Invalid password.');
		}
		return new NS\Identity($row->id, $row->role, ['username' => $row->username]);
	}

	/**
	 * Adds new user.
	 *
	 * @param  string
	 * @param  string
	 * @return void
	 */
	public function add($username, $password)
	{
		try {
			$this->database->table(self::TABLE_NAME)->insert([
				self::COLUMN_NAME => $username,
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			]);
		} catch (Nette\Database\UniqueConstraintViolationException $e) {
			throw new DuplicateNameException;
		}
	}
}

class DuplicateNameException extends \Exception
{
}
