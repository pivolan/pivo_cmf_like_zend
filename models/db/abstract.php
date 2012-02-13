<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 12.02.12
 * Time: 21:11
 * To change this template use File | Settings | File Templates.
 */

class models_db_abstract
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

	protected $_fields;

	static function init()
	{
		$server = 'localhost';
		$login = 'root';
		$pass = '';
		mysql_connect($server, $login, $pass);
	}
}
