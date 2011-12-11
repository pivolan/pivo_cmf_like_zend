<?php
/**
 * Created by PhpStorm.
 * User: pivo
 * Date: 24.04.2011
 * Time: 4:15:07
 * To change this template use File | Settings | File Templates.
 */

abstract class controller
{
	public $action;
	public $view;

	function __construct()
	{

	}

	function preDispatch()
	{

	}

	function postDispatch()
	{

	}

	function render($action, $controller = null)
	{
		$this->render = '8';
	}
}