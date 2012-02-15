<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 12.02.12
 * Time: 21:13
 * To change this template use File | Settings | File Templates.
 */
namespace models\entity;
use models\db\Adb;

class blog {
	protected $id, $data = array();
	protected $chdata = array();

	function __construct()
	{
		
	}

	static function get($id)
	{

	}

	static function create($message)
	{
		$result = new models_entity_blog();

	}

	function save()
	{

	}
}
