<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 12.02.12
 * Time: 21:11
 * To change this template use File | Settings | File Templates.
 */

class models_db_like extends models_db_abstract
{
	protected $_fields = array(
		self::KN_ID => '',
		self::KN_OWNER_ID => '',
		self::KN_BLOG_ID => '',
		self::KN_DATE => '',
	);
	static protected $_table = self::TN_LIKE;

}
