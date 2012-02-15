<?php
/**
 * Created by PhpStorm.
 * User: pivo
 * Date: 24.04.2011
 * Time: 3:22:50
 * To change this template use File | Settings | File Templates.
 */
namespace controllers;

class index extends \library\controller
{
	public $page;

	function preDispatch()
	{
		parent::preDispatch();
	}

	function postDispatch()
	{
	}

	function index()
	{
		$this->view->user = $this->current_user->as_array();
		$this->view->test = 'test';
	}

	function blog()
	{
		$this->view->blog = array('text' => 'ghjdthrf');
	}
}
