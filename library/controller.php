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
use models\db\Adb;
use models\busines\event;
abstract class controller
{
	public $action;
	public $view;
	protected $url = array();

	protected $current_user;

	function __construct()
	{
		session_start();
		db\Adb::init();
	}

	function preDispatch()
	{
		// авторизуемся
		/** @var $user \models\entity\user */
		$user = event\authorization::run();
		if (!$user)
		{
			//если не вышло - регистрируемся
			$user = event\registration::run();
		}
		if ($user)
		{
			$this->current_user = $user;
			$this->view->user = array(
				Adb::KN_DATE_REG => $user->get_date_reg(),
				Adb::KN_URL => $user->get_url(),
				Adb::KN_FIO => $user->get_fio(),
				Adb::KN_ID => $user->get_id(),
				Adb::KN_LOGIN => $user->get_login()
			);
		}
		else
		{
			throw new Exception(' Cannot create or auth ');
		}
	}

	function getParam($num)
	{

	}

	function setUrl($url)
	{

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

	/**
	 * @return \models\entity\user
	 */
	function get_auth_user()
	{
		if ($this->current_user)
		{
			return $this->current_user;
		}
		else
		{
			throw new Exception('not auth');
		}
	}

}