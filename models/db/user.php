<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 12.02.12
 * Time: 21:11
 * To change this template use File | Settings | File Templates.
 */
namespace models\db;
class user extends Adb
{
	static protected $_fields = array(
		self::KN_ID => '',
		self::KN_FIO => '',
		self::KN_DATE_REG => '',
		self::KN_LOGIN => '',
		self::KN_PASSWORD => '',
		self::KN_COOKIE_ID => '',
		self::KN_URL => '',
	);
	static protected $_table = self::TN_USER;

	static public function find_by_cookie_id($cookie_id)
	{
		$result = false;
		$cookie_id = mysql_real_escape_string($cookie_id);
		$query_result = mysql_query("SELECT * FROM " . self::$_table . " WHERE " . self::KN_COOKIE_ID . " = '$cookie_id'");
		if ($query_result)
		{
			while ($line = mysql_fetch_assoc($query_result))
			{
				$result = $line;
			}
		}
		return $result;
	}

	static public function find_by_url($url)
	{
		$result = false;
		$url = mysql_real_escape_string($url);
		$sql = "SELECT * FROM " . self::$_table . " WHERE " . self::KN_URL . " = '$url'";
		$query_result = mysql_query($sql);
		if ($query_result)
		{
			while ($line = mysql_fetch_assoc($query_result))
			{
				$result = $line;
			}
		}
		return $result;
	}

	static public function search_by_fio($fio)
	{
		$result = array();
		$fio = mysql_real_escape_string($fio);
		$sql = "SELECT * FROM " . self::$_table . " WHERE " . self::KN_FIO . " like '%$fio%'";
		$query_result = mysql_query($sql);
		if ($query_result)
		{
			while ($line = mysql_fetch_assoc($query_result))
			{
				if (isset($line[Adb::KN_ID]))
				{
					$result[$line[Adb::KN_ID]] = $line;
				}
			}
		}
		return $result;
	}

	static public function get_multi($ids = array())
	{
		$result = array();
		foreach($ids as $key => $id)
		{
			$ids[$key] = mysql_real_escape_string($id);
		}

		$ids_string = "(".implode(",", $ids). ")";
		$sql = "SELECT * FROM " . self::$_table . " WHERE " . self::KN_ID . " IN $ids_string";
		$query_result = mysql_query($sql);
		if ($query_result)
		{
			while ($line = mysql_fetch_assoc($query_result))
			{
				if (isset($line[Adb::KN_ID]))
				{
					$result[$line[Adb::KN_ID]] = $line;
				}
			}
		}
		return $result;
	}
}
