<?php
/**
 * Created by PhpStorm.
 * User: pivo
 * Date: 24.04.2011
 * Time: 4:15:07
 * To change this template use File | Settings | File Templates.
 */
namespace library;
use models\db;
use models\busines\event;
abstract class controller
{
	public $action;
	public $view;

	protected $current_user;

	function __construct()
	{

	}

	function preDispatch()
	{
		session_start();
		db\Adb::init();
		// авторизуемся
		$user = event\authorization::run();
		if (!$user)
		{
			//если не вышло - регистрируемся
			$user = event\registration::run();
		}
		if ($user)
		{
			$this->current_user = $user;
		}
		else
		{
			throw new Exception(' Cannot create or auth ');
		}
	}

	function postDispatch()
	{

	}

	function render($action, $controller = null)
	{
		$this->render = '8';
	}

	function redirect($url = '')
	{
		if (empty($url))
		{
			$url = $_SERVER['REQUEST_URI'];
		}
		header("location: $url");
	}

}