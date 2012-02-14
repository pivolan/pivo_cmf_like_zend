<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 14.02.12
 * Time: 0:41
 * To change this template use File | Settings | File Templates.
 */

class models_busines_event_registration extends models_busines_event_abstract
{
	const SN_ID = 'user_id';

	static public function run()
	{
		$user = models_entity_user::create();
		setcookie(models_busines_event_authorization::CK_ID, $user->get_cookie_id(), mktime(null, null, null, null, null, date('Y') + 1));
		$_SESSION[self::SN_ID] = $user->get_id();
		return $user;
	}
}
