<?php

namespace App;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList();
		$router[] = $adminRouter = new RouteList('Admin');
		$adminRouter[] = new Route('sign', 'Sign:in');
		$adminRouter[] = new Route('dashboard', 'Dashboard:');
		$adminRouter[] = new Route('logout', 'Sign:out');
		$adminRouter[] = new Route('edit', 'Post:edit');
		$adminRouter[] = new Route('delete', 'Post:delete');
		$adminRouter[] = new Route('create', 'Post:create');
		$adminRouter[] = new Route('setting', 'Setting:edit');
		$adminRouter[] = new Route('comments', 'Comments:');
		$router[] = $frontRouter = new RouteList('Front');
		$frontRouter[] = new Route('', 'Homepage:');
		$frontRouter[] = new Route('post', 'Post:');
		return $router;
	}

}
