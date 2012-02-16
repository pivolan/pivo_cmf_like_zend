<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 14.02.12
 * Time: 0:41
 * To change this template use File | Settings | File Templates.
 */
namespace models\busines\event;
use \models\db\Adb;
class create_blog extends Aevent
{
	static public function run()
	{
		
	}
	static public function create($message, $current_user)
	{
		$xss_filter = new \models\filter\xss_clean_filter;
		$message = $xss_filter->filter($message);
		$message = \models\filter\find_link_away::static_filter($message);
		$message = strip_tags($message, '<div>,<p>,<img>,<a>,<span>,<b>,<i>,<em>,<strong>,<u>,<ul>,<li>,<ol>');
		$message = nl2br($message);
		$blog = \models\entity\blog::create($message, $current_user->get_id());
		return $blog;
	}
}