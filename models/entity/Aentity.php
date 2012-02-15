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

abstract class Aentity
{
	protected $data = array(), $id;
	protected $chdata = array();

	abstract static public function get($id);

	public function as_array()
	{
		$data = $this->data;
		$data[Adb::KN_ID] = $this->get_id();
		foreach ($this->chdata as $key => $value)
		{
			$data[$key] = $value;
		}
		return $data;
	}

	function __construct($id, $data)
	{
		$this->id = $id;
		$this->data = $data;
	}
}
