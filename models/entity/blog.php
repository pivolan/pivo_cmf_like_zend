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

class blog extends Aentity
{
	protected $id, $data = array();
	protected $chdata = array();
	static protected $entity = array();

	static public function get($id)
	{
		// singleton
		if (isset(self::$entity[$id]))
		{
			return self::$entity[$id];
		}
		$result = false;

		$data = \models\db\blog::get($id);
		if ($data && is_array($data) && isset($data[Adb::KN_ID]))
		{
			$result = new self($id, $data);
			// singleton
			self::$entity[$id] = $result;
		}
		return $result;
	}

	static public function create($message, $owner_id, $date_create = null)
	{
		$data = array(
			Adb::KN_MESSAGE => $message,
			Adb::KN_OWNER_ID => $owner_id,
		);
		if ($date_create)
		{
			$data[Adb::KN_DATE_CREATE] = $date_create;
		}
		else
		{
			$data[Adb::KN_DATE_CREATE] = time();
		}
		$id = \models\db\blog::add($data);

		$result = new self($id, $data);
		self::$entity[$id] = $result;
		return $result;
	}

	public function save()
	{
		\models\db\blog::edit($this->get_id(), $this->chdata);
	}

	/** GET start */
	public function get_id()
	{
		return $this->id;
	}

	public function get_message()
	{
		$result = null;
		if (isset($this->chdata[Adb::KN_MESSAGE]))
		{
			$result = $this->chdata[Adb::KN_MESSAGE];
		}
		elseif (isset($this->data[Adb::KN_MESSAGE]))
		{
			$result = $this->data[Adb::KN_MESSAGE];
		}
		return $result;
	}

	public function get_owner_id()
	{
		$result = null;
		if (isset($this->chdata[Adb::KN_OWNER_ID]))
		{
			$result = $this->chdata[Adb::KN_OWNER_ID];
		}
		elseif (isset($this->data[Adb::KN_OWNER_ID]))
		{
			$result = $this->data[Adb::KN_OWNER_ID];
		}
		return $result;
	}

	public function get_date_create()
	{
		$result = null;
		if (isset($this->chdata[Adb::KN_DATE_CREATE]))
		{
			$result = $this->chdata[Adb::KN_DATE_CREATE];
		}
		elseif (isset($this->data[Adb::KN_DATE_CREATE]))
		{
			$result = $this->data[Adb::KN_DATE_CREATE];
		}
		return $result;
	}
	// GET end */

	/** SET start */
	public function set_message($message)
	{
		$this->chdata[Adb::KN_MESSAGE] = $message;
	}
	public function set_owner_id($owner_id)
	{
		$this->chdata[Adb::KN_OWNER_ID] = $owner_id;
	}
	// SET end
}
