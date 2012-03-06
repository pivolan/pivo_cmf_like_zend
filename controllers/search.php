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

class search extends \library\controller
{
	public $page;

	function preDispatch()
	{
	}

	function postDispatch()
	{
	}

	function user($fio = null)
	{
		$result = array();

		if (isset($_POST[Adb::KN_FIO]))
		{
			$fio = $_POST[Adb::KN_FIO];
		}
		elseif (isset($fio))
		{
			$fio = urldecode($fio);
		}

		$users = entity\user::search_by_fio($fio);
		/** @var $user \models\entity\user */
		foreach ($users as $id => $user)
		{
			$result[$id] = array(
				Adb::KN_ID => $id,
				Adb::KN_FIO => $user->get_fio(),
			);
		}
		$this->json($result);
	}

	function blog($message = null)
	{
		$result = array();

		if (isset($_POST[Adb::KN_MESSAGE]))
		{
			$message = $_POST[Adb::KN_MESSAGE];
		}
		elseif (isset($message))
		{
			$message = urldecode($message);
		}

		$blogs = entity\blog::search_by_message($message);
		/** @var $blog \models\entity\blog */
		foreach ($blogs as $id => $blog)
		{
			$user_ids[$blog->get_owner_id()] = 1;
		}
		$users = \models\entity\user::get_multi(array_keys($user_ids));

		/** @var $blog \models\entity\blog */
		foreach ($blogs as $id => $blog)
		{
			/** @var $owner \models\entity\user */
			$owner = $users[$blog->get_owner_id()];
			$result[$id] = array(
				Adb::KN_ID => $id,
				Adb::KN_MESSAGE => $blog->get_message(),
				Adb::KN_DATE_CREATE => $blog->get_date_create(),
				Adb::KN_OWNER_ID => $blog->get_owner_id(),
				Adb::KN_FIO => $owner->get_fio(),
			);
		}
		$this->json($result);
	}

	function blog_all()
	{
		$result = array();

		$blogs = entity\blog::get_all();
		/** @var $blog \models\entity\blog */
		foreach ($blogs as $id => $blog)
		{
			$user_ids[$blog->get_owner_id()] = 1;
		}
		$users = \models\entity\user::get_multi(array_keys($user_ids));
		foreach ($blogs as $id => $blog)
		{
			/** @var $owner \models\entity\user */
			$owner = $users[$blog->get_owner_id()];
			$result[$id] = array(
				Adb::KN_ID => $id,
				Adb::KN_MESSAGE => $blog->get_message(),
				Adb::KN_DATE_CREATE => $blog->get_date_create(),
				Adb::KN_OWNER_ID => $blog->get_owner_id(),
				Adb::KN_FIO => $owner->get_fio(),
			);
		}

		$this->json($result);
	}

	function blog_owner($owner_id = null)
	{
		$result = array();

		if (isset($_POST[Adb::KN_OWNER_ID]))
		{
			$owner_id = $_POST[Adb::KN_OWNER_ID];
		}
		elseif (isset($owner_id))
		{
			$owner_id = urldecode($owner_id);
		}

		$owner = entity\user::get($owner_id);
		$blogs = entity\blog::search_by_owner_id($owner_id);
		/** @var $blog \models\entity\blog */
		foreach ($blogs as $id => $blog)
		{
			$result[$id] = array(
				Adb::KN_ID => $id,
				Adb::KN_MESSAGE => $blog->get_message(),
				Adb::KN_DATE_CREATE => $blog->get_date_create(),
				Adb::KN_OWNER_ID => $blog->get_owner_id(),
				Adb::KN_FIO => $owner->get_fio(),
			);
		}
		$this->json($result);
	}

	function blog_owner_paginate($owner_id = null, $from = null, $count = 10)
	{
		$result = array();

		if (isset($_POST[Adb::KN_OWNER_ID]))
		{
			$owner_id = $_POST[Adb::KN_OWNER_ID];
		}
		elseif (isset($owner_id) && is_numeric($owner_id) && $owner_id > 0)
		{
			$owner_id = urldecode($owner_id);
		}
		else
		{
			$owner_id = $this->get_auth_user()->get_id();
		}
		$owner = entity\user::get($owner_id);
		$blogs = entity\blog::search_by_owner_id_paginate($owner_id, $from, $count);
		/** @var $blog \models\entity\blog */
		foreach ($blogs as $id => $blog)
		{
			$result[$id] = array(
				Adb::KN_ID => $id,
				Adb::KN_MESSAGE => $blog->get_message(),
				Adb::KN_DATE_CREATE => $blog->get_date_create(),
				Adb::KN_OWNER_ID => $blog->get_owner_id(),
				Adb::KN_FIO => $owner->get_fio(),
			);
		}
		$this->json($blogs);
//		$this->json($result);
	}

	function edit()
	{

	}
}
