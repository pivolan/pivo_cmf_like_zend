<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 12.02.12
 * Time: 21:11
 * To change this template use File | Settings | File Templates.
 */

class models_db_user extends models_db_abstract
{
	protected $_fields = array(
		self::KN_ID => '',
		self::KN_FIO => '',
		self::KN_DATE_REG => '',
		self::KN_LOGIN => '',
		self::KN_PASSWORD => '',
		self::KN_URL => '',
	);
	static protected $_table = self::TN_USER;

}
