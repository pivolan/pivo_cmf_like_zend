<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 12.02.12
 * Time: 21:13
 * To change this template use File | Settings | File Templates.
 */

abstract class models_entity_abstract
{
	protected $data, $id;
	protected $chdata = array();

	abstract static public function get($id);

	public function as_array()
	{
		$data = $this->data;
		$data[models_db_abstract::KN_ID] = $this->get_id();
		foreach($this->chdata as $key => $value)
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
