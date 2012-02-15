<?php
/**
 * Created by PhpStorm.
 * User: pivo
 * Date: 24.04.2011
 * Time: 4:15:07
 * To change this template use File | Settings | File Templates.
 */
namespace library;
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
		\models\db\Adb::init();
		$this->current_user = \models\busines\event\authorization::run();
	}

	function postDispatch()
	{

	}

	function render($action, $controller = null)
	{
		$this->render = '8';
	}
}