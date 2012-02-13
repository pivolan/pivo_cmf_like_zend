<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 14.02.12
 * Time: 0:41
 * To change this template use File | Settings | File Templates.
 */

class models_busines_event_authorization extends models_busines_event_abstract
{
	const SN_ID = 'user_id';

	static public function run()
	{
		if(isset($_SESSION[self::SN_ID]) && is_numeric($_SESSION[self::SN_ID]))
		{
			$id = $_SESSION[self::SN_ID];
			$user = models_entity_user::get($id);
			if(!$user)
			{

			}
		}
		else
		{

		}
	}
}
