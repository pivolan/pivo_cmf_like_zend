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
class user extends Aentity
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
		if ($data && is_array($data) && isset($data[\models\db\user::KN_ID]))
		{
			$result = new self($id, $data);
			// singleton
			self::$entity[$id] = $result;
		}
		return $result;
	}

	static public function find_by_cookie_id($cookie_id)
	{
		$result = false;

		$data = \models\db\user::find_by_cookie_id($cookie_id);
		if ($data && is_array($data) && isset($data[\models\db\user::KN_ID]))
		{
			$result = new self($cookie_id, $data);
		}
		return $result;
	}

	static public function create($fio = 'Guest', $login = null, $password = null, $url = null, $date_reg = null, $cookie_id = null)
	{
		$data = array(
			Adb::KN_FIO => $fio,
		);
		if (isset($login))
		{
			$data[Adb::KN_LOGIN] = $login;
		}
		if (isset($password))
		{
			$data[Adb::KN_PASSWORD] = md5($password);
		}
		if (isset($url))
		{
			$data[Adb::KN_URL] = $url;
		}
		if (isset($date_reg) && is_numeric($date_reg))
		{
			$data[Adb::KN_DATE_REG] = $date_reg;
		}
		else
		{
			$data[Adb::KN_DATE_REG] = time();
		}
		if (isset($cookie_id) && is_numeric($cookie_id))
		{
			$data[Adb::KN_COOKIE_ID] = $cookie_id;
		}
		else
		{
			$data[Adb::KN_COOKIE_ID] = self::generate_cookie_id();
		}

		$id = \models\db\user::add($data);

		$result = new self($id, $data);
		self::$entity[$id] = $result;
		return $result;
	}

	static public function generate_cookie_id()
	{
		if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	public function update_cookie_id()
	{
		$cookie_id = self::generate_cookie_id();
		$this->set_cookie_id($cookie_id);
		return $cookie_id;
	}

	public function save()
	{
		\models\db\user::edit($this->get_id(), $this->chdata);
	}

	/** GET start */
	public function get_id()
	{
		return $this->id;
	}

	public function get_fio()
	{
		$result = null;
		if (isset($this->chdata[Adb::KN_FIO]))
		{
			$result = $this->chdata[Adb::KN_FIO];
		}
		elseif (isset($this->data[Adb::KN_FIO]))
		{
			$result = $this->data[Adb::KN_FIO];
		}
		return $result;
	}

	public function get_date_reg()
	{
		$result = null;
		if (isset($this->chdata[Adb::KN_DATE_REG]))
		{
			$result = $this->chdata[Adb::KN_DATE_REG];
		}
		elseif (isset($this->data[Adb::KN_DATE_REG]))
		{
			$result = $this->data[Adb::KN_DATE_REG];
		}
		return $result;
	}

	public function get_login()
	{
		$result = null;
		if (isset($this->chdata[Adb::KN_LOGIN]))
		{
			$result = $this->chdata[Adb::KN_LOGIN];
		}
		elseif (isset($this->data[Adb::KN_LOGIN]))
		{
			$result = $this->data[Adb::KN_LOGIN];
		}
		return $result;
	}

	public function get_url()
	{
		$result = null;
		if (isset($this->chdata[Adb::KN_URL]))
		{
			$result = $this->chdata[Adb::KN_URL];
		}
		elseif (isset($this->data[Adb::KN_URL]))
		{
			$result = $this->data[Adb::KN_URL];
		}
		return $result;
	}

	public function get_cookie_id()
	{
		$result = null;
		if (isset($this->chdata[Adb::KN_COOKIE_ID]))
		{
			$result = $this->chdata[Adb::KN_COOKIE_ID];
		}
		elseif (isset($this->data[Adb::KN_COOKIE_ID]))
		{
			$result = $this->data[Adb::KN_COOKIE_ID];
		}
		return $result;
	}

	// GET end

	/** SET start */
	public function set_fio($fio)
	{
		$this->chdata[Adb::KN_FIO] = $fio;
	}

	public function set_login($login)
	{
		$this->chdata[Adb::KN_LOGIN] = $login;
	}

	public function set_password($password)
	{
		$this->chdata[Adb::KN_PASSWORD] = md5($password);
	}

	public function set_cookie_id($cookie_id)
	{
		$this->chdata[Adb::KN_COOKIE_ID] = $cookie_id;
	}

	public function set_url($url)
	{
		$this->chdata[Adb::KN_URL] = $url;
	}
	// SET end
}
