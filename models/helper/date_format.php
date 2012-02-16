<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 16.02.12
 * Time: 1:44
 * To change this template use File | Settings | File Templates.
 */

namespace models\helper;
class date_format
{
	static function dmy($date)
	{
		return date('d.m.Y', $date);
	}

	static function dmyms($date)
	{
		return date('d.m.Y h:i:s', $date);
	}
}
