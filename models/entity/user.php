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
	protected static $entity = array();

	protected $data, $id;
	protected $chdata;

	static public function get($id)
	{
		// singleton
		if (isset(self::$entity[$id]))
		{
			return self::$entity[$id];
		}
		$result = false;

		$data = models_db_user::get($id);
		if ($data && is_array($data) && isset($data[models_db_user::KN_ID]))
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

		$data = models_db_user::find_by_cookie_id($cookie_id);
		if ($data && is_array($data) && isset($data[models_db_user::KN_ID]))
		{
			$result = new self($cookie_id, $data);
		}
		return $result;
	}

	static public function create($fio = 'Guest', $login = null, $password = null, $url = null, $date_reg = null, $cookie_id = null)
	{
		$data = array(
			models_db_abstract::KN_FIO => $fio,
		);
		if (isset($login))
		{
			$data[models_db_abstract::KN_LOGIN] = $login;
		}
		if (isset($password))
		{
			$data[models_db_abstract::KN_PASSWORD] = md5($password);
		}
		if (isset($url))
		{
			$data[models_db_abstract::KN_URL] = $url;
		}
		if (isset($date_reg) && is_numeric($date_reg))
		{
			$data[models_db_abstract::KN_DATE_REG] = $date_reg;
		}
		else
		{
			$data[models_db_abstract::KN_DATE_REG] = time();
		}
		if (isset($cookie_id) && is_numeric($cookie_id))
		{
			$data[models_db_abstract::KN_COOKIE_ID] = $cookie_id;
		}
		else
		{
			$data[models_db_abstract::KN_COOKIE_ID] = self::generate_cookie_id();
		}

		$id = models_db_user::add($data);

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
		models_db_user::edit($this->get_id(), $this->chdata);
	}

	/** GET start */
	public function get_id()
	{
		return $this->id;
	}

	public function get_fio()
	{
		$result = null;
		if (isset($this->chdata[models_db_abstract::KN_FIO]))
		{
			$result = $this->chdata[models_db_abstract::KN_FIO];
		}
		elseif (isset($this->data[models_db_abstract::KN_FIO]))
		{
			$result = $this->data[models_db_abstract::KN_FIO];
		}
		return $result;
	}

	public function get_date_reg()
	{
		$result = null;
		if (isset($this->chdata[models_db_abstract::KN_DATE_REG]))
		{
			$result = $this->chdata[models_db_abstract::KN_DATE_REG];
		}
		elseif (isset($this->data[models_db_abstract::KN_DATE_REG]))
		{
			$result = $this->data[models_db_abstract::KN_DATE_REG];
		}
		return $result;
	}

	public function get_login()
	{
		$result = null;
		if (isset($this->chdata[models_db_abstract::KN_LOGIN]))
		{
			$result = $this->chdata[models_db_abstract::KN_LOGIN];
		}
		elseif (isset($this->data[models_db_abstract::KN_LOGIN]))
		{
			$result = $this->data[models_db_abstract::KN_LOGIN];
		}
		return $result;
	}

	public function get_url()
	{
		$result = null;
		if (isset($this->chdata[models_db_abstract::KN_URL]))
		{
			$result = $this->chdata[models_db_abstract::KN_URL];
		}
		elseif (isset($this->data[models_db_abstract::KN_URL]))
		{
			$result = $this->data[models_db_abstract::KN_URL];
		}
		return $result;
	}

	public function get_cookie_id()
	{
		$result = null;
		if (isset($this->chdata[models_db_abstract::KN_COOKIE_ID]))
		{
			$result = $this->chdata[models_db_abstract::KN_COOKIE_ID];
		}
		elseif (isset($this->data[models_db_abstract::KN_COOKIE_ID]))
		{
			$result = $this->data[models_db_abstract::KN_COOKIE_ID];
		}
		return $result;
	}

	// GET end

	/** SET start */
	public function set_fio($fio)
	{
		$this->chdata[models_db_abstract::KN_FIO] = $fio;
	}

	public function set_login($login)
	{
		$this->chdata[models_db_abstract::KN_LOGIN] = $login;
	}

	public function set_password($password)
	{
		$this->chdata[models_db_abstract::KN_PASSWORD] = md5($password);
	}

	public function set_cookie_id($cookie_id)
	{
		$this->chdata[models_db_abstract::KN_COOKIE_ID] = $cookie_id;
	}

	public function set_url($url)
	{
		$this->chdata[models_db_abstract::KN_URL] = $url;
	}
	// SET end
}
