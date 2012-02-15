<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 14.02.12
 * Time: 0:41
 * To change this template use File | Settings | File Templates.
 */
namespace models\busines\event;

class authorization extends Aevent
{
	const SN_ID = 'user_id';
	const CK_ID = 'cookie_id';

	static public function run()
	{
		$user = false;
		if (isset($_SESSION[self::SN_ID]) && is_numeric($_SESSION[self::SN_ID]))
		{
			$id = self::get_identity();
			$user = \models\entity\user::get($id);
			// если пользователь есть - сохраним ему cookie
			if ($user)
			{
				$cookie_id = \models\entity\user::generate_cookie_id();
				$user->set_cookie_id($cookie_id);
				setcookie(self::CK_ID, $cookie_id, mktime(null, null, null, null, null, date('Y') + 1));
				$user->save();
			}
			else
			{
				$user = registration::run();
			}
		}
		elseif (isset($_COOKIE[self::CK_ID]) && !empty($_COOKIE[self::CK_ID]))
		{
			$user = \models\entity\user::find_by_cookie_id($_COOKIE[self::CK_ID]);
			if ($user)
			{
				$_SESSION[self::SN_ID] = $user->get_id();
			}
			else
			{
				$user = registration::run();
			}
		}
		else
		{
			$user = registration::run();
		}

		if(!$user)
		{
			throw new Exception('cannot create user');
		}
		return $user;
	}

	static public function get_identity()
	{
		if (isset($_SESSION[self::SN_ID]))
		{
			return $_SESSION[self::SN_ID];
		}
		return false;
	}

	static public function get_auth_user()
	{
		$user_id = self::get_identity();
		$result = false;
		if ($user_id)
		{
			$result = \models\entity\user::get($user_id);
		}
		return $result;
	}
}
