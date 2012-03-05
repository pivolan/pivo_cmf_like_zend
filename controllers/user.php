<?php
/**
 * Created by PhpStorm.
 * User: pivo
 * Date: 24.04.2011
 * Time: 3:22:50
 * To change this template use File | Settings | File Templates.
 */
namespace controllers;
use \models\entity;
use \models\db;

class user extends \library\controller
{
	public $page;

	function preDispatch()
	{
		parent::preDispatch();
	}

	function postDispatch()
	{
	}

	function editname()
	{
		$user = $this->get_auth_user();

		if (isset($_POST['fio']))
		{
			$fio = $_POST['fio'];
			$fio = \models\filter\xss_clean_filter::static_filter($fio);
			$user->set_fio($fio);
			$user->save();
			if ($this->is_xml_http_request())
			{
				$this->json(array('id' => $user->get_id(), 'fio' => $fio));
			}
			else
			{
				$this->redirect('');
			}
		}
		$this->view->fio = $user->get_fio();
	}


	function blog()
	{
		$this->view->blog = array('text' => 'ghjdthrf');
	}

	function updateurl()
	{
		/** @var $user \models\entity\user */
		$user = $this->get_auth_user();
		$url = $user->update_url();
		$user->save();
		echo $url;
	}

	function avaupload()
	{

	}
}
