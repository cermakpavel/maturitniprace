<?php

namespace App;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;


class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList();
		$router[] = $frontRouter = new RouteList('Front');
		$frontRouter[] = new Route('home', 'Homepage:');
		$frontRouter[] = new Route('post', 'Post:');
		$router[] = $adminRouter = new RouteList('Admin');
		$adminRouter[] = new Route('admin', 'Sign:in');
		$adminRouter[] = new Route('dashboard', 'Dashboard:');
		$adminRouter[] = new Route('logout', 'Sign:out');
		$adminRouter[] = new Route('edit', 'Post:edit');
		$adminRouter[] = new Route('', 'Post:delete');
		$adminRouter[] = new Route('create', 'Post:create');
		$adminRouter[] = new Route('setting', 'Setting:edit');
		return $router;
	}

}
