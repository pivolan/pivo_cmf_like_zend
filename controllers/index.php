<?php
/**
 * Created by PhpStorm.
 * User: pivo
 * Date: 24.04.2011
 * Time: 3:22:50
 * To change this template use File | Settings | File Templates.
 */
 
class controllers_index extends controller{
	public $page;

	function preDispatch()
	{
		session_start();
		global $db;
		$this->db = $db;
		for ($i = 1; $i <= 7; $i++)
		{
			$this->but[$i] = "but$i";
		}
		$this->page = 'main';
		$this->text = 'main';
		$this->view->text = '';
		$this->alt = 'Главная';
	}
	function postDispatch()
	{
	}
	function index()
	{
	}
}
