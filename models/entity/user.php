<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 12.02.12
 * Time: 21:13
 * To change this template use File | Settings | File Templates.
 */

class models_entity_user extends models_entity_abstract
{
	protected $data, $id;

	static public function get($id)
	{
		$result = false;

		$data = models_db_user::get($id);
		if($data && is_array($data) && isset($data[models_db_user::KN_ID]))
		{
			$result = new self($id, $data);
		}
		return $result;
	}

	static public function create($fio = 'Guest', $login = null, $password = null, $url = null, $date_reg = null)
	{
		
	}
}
