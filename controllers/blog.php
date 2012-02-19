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
use \models\entity;
use \models\filter;

class blog extends \library\controller
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
	}

	function view($id)
	{
		/** @var $blog \models\entity\blog */
		$blog = \models\entity\blog::get($id);
		$this->view->blog = array(
			Adb::KN_ID => $blog->get_id(),
			Adb::KN_MESSAGE => $blog->get_message(),
			Adb::KN_DATE_CREATE => $blog->get_date_create(),
			Adb::KN_OWNER_ID => $blog->get_owner_id(),
		);
	}

	function create()
	{
		if (isset($_POST[Adb::KN_MESSAGE]))
		{
			$message = $_POST[Adb::KN_MESSAGE];
			$current_user = $this->get_auth_user();
			$blog = \models\busines\event\create_blog::create($message, $current_user);
			if ($this->is_xml_http_request())
			{
				$this->json(array(
					Adb::KN_ID => $blog->get_id(),
					Adb::KN_MESSAGE => $blog->get_message(),
					Adb::KN_DATE_CREATE => $blog->get_date_create(),
					Adb::KN_OWNER_ID => $blog->get_owner_id(),
					Adb::KN_FIO => $current_user->get_fio(),
				));
			}
			else
			{
				$this->redirect('/blog/view/' . $blog->get_id());
			}
		}
	}

	function delete($id = null)
	{
		if (isset($id) && is_numeric($id) && $id > 0)
		{
			$blog = entity\blog::get($id);
			if($this->get_auth_user()->get_id() == $blog->get_owner_id())
			{
				$blog->delete();
			}
			else
			{
				throw new \Exception('You are not author');
			}
		}
		else
		{
			throw new \Exception('id is not valid');
		}
	}

	function edit()
	{

	}
}
