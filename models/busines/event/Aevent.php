<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 14.02.12
 * Time: 0:43
 * To change this template use File | Settings | File Templates.
 */
namespace models\busines\event;

abstract class Aevent
{
	abstract static public function run();
}
