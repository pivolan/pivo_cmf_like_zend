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
class attachment extends Aentity
{
	protected static $entity = array();

	protected $data = array(), $id;
	protected $chdata = array();

	static public function get($id)
	{
		// singleton
		if (isset(self::$entity[$id]))
		{
			return self::$entity[$id];
		}
		$result = false;

		$data = \models\db\user::get($id);
		if ($data && is_array($data) && isset($data[Adb::KN_ID]))
		{
			$result = new self($id, $data);
			// singleton
			self::$entity[$id] = $result;
		}
		return $result;
	}

	static public function get_multi($ids = array())
	{
		$result = false;

		$data_array = \models\db\user::get_multi($ids);
		foreach($data_array as $id=>$data)
		{
			$result[$id] = new self($id, $data);
		}
		return $result;
	}

	function delete()
	{
		\models\db\user::delete($this->get_id());
	}

	/** GET start */
	// GET end

	/** SET start */
	// SET end
}
