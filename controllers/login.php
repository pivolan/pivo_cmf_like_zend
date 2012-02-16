<?php
/**
 * Created by PhpStorm.
 * User: pivo
 * Date: 24.04.2011
 * Time: 3:22:50
 * To change this template use File | Settings | File Templates.
 */
namespace controllers;
use \models\db\Adb;
use \models\busines\event\authorization;
class login extends \library\controller
{
	public $page;

	function preDispatch()
	{
	}

	function postDispatch()
	{
	}

	function url($url = null)
	{
		if(!$url)
		{
			parent::preDispatch();
			$user = $this->get_auth_user();
			$url = $user->update_url();
			$user->save();
			$this->redirect('/login/url/'.$url);
		}
		else
		{
			$user = authorization::by_url($url);
			if(!$user)
			{
				throw new \Exception('url not found');
			}
		}

		echo $url.DS;
		echo $user->get_id();
	}
}
