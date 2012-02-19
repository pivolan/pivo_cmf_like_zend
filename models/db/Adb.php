<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 12.02.12
 * Time: 21:11
 * To change this template use File | Settings | File Templates.
 */
namespace models\db;
abstract class Adb
{
	const KN_ID = 'id';
	const KN_MESSAGE = 'message';
	const KN_OWNER_ID = 'owner_id';
	const KN_BLOG_ID = 'blog_id';
	const KN_DATE = 'date';
	const KN_DATE_CREATE = 'date_create';
	const KN_DATE_REG = 'date_reg';
	const KN_URL = 'url';
	const KN_PASSWORD = 'password';
	const KN_LOGIN = 'login';
	const KN_FIO = 'fio';
	const KN_COOKIE_ID = 'cookie_id';

	const TN_BLOG = 'blog';
	const TN_USER = 'user';
	const TN_LIKE = 'like';

    const CF_PAGINATE_COUNT = 10;

	static protected $_fields;
	static protected $_table;

	static function init()
	{
		$server = 'localhost';
		$login = 'root';
		$pass = 'root123';
		$db_name = 'pivo_chat';
		mysql_connect($server, $login, $pass) or die('cannot connect');
		mysql_select_db($db_name) or die('cannot select db');
		mysql_query('SET NAMES "utf8"');
	}

	static public function get($id)
	{
		$result = false;
		$query_result = mysql_query("SELECT * FROM " . static::$_table . " WHERE " . self::KN_ID . " = " . $id);
		if ($query_result)
		{
			while ($line = mysql_fetch_assoc($query_result))
			{
				$result = $line;
			}
		}
		return $result;
	}

	static public function add($data)
	{
		$toDb = array();
		$sql = '';
		$keys = array();
		$values = array();

		foreach ($data as $key => $value)
		{
			if (isset(static::$_fields[$key]))
			{
				$keys[] = $key;
				$values[] = mysql_real_escape_string($value);
			}
		}
		if (count($keys) > 0)
		{
			$sql_keys = implode(',', $keys);
			$sql_values = "'" . implode("','", $values) . "'";

			$sql = "INSERT INTO " . static::$_table . " (" . $sql_keys . ") VALUES (" . $sql_values . ")";
			$result = mysql_query($sql);
			return mysql_insert_id();
		}
		return false;
	}

	static public function edit($id, $data)
	{
		if (!is_numeric($id))
		{
			throw new Edb("ID is not integer");
		}
		$toDb = array();
		$sql = '';
		$keys = array();
		$values = array();

		foreach ($data as $key => $value)
		{
			if (isset(static::$_fields[$key]))
			{
				$sql_data[] = $key . "='" . mysql_real_escape_string($value) . "'";
			}
		}
		if (count($sql_data) > 0)
		{
			$sql_update = implode(',', $sql_data);
			unset($sql_data);
			$sql = "UPDATE " . static::$_table . " SET " . $sql_update . " WHERE " . self::KN_ID . "=" . $id;
			$result = mysql_query($sql);
		}
	}

	static public function delete($id)
	{
		if (!is_numeric($id))
		{
			throw new models_db_exception("ID is not integer");
		}
		$sql = "DELETE FROM " . static::$_table . " WHERE " . self::KN_ID . "=" . $id;
		$result = mysql_query($sql);
	}

}
