<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 16.02.12
 * Time: 3:19
 * To change this template use File | Settings | File Templates.
 */
namespace models\filter;

abstract class Afilter
{
	abstract public function filter($message);
	abstract static public function static_filter($message);
}
