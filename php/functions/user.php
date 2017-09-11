<?php

class User
{
	public static function login($username, $password)
	{
		if (isset($_SESSION['id']))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"Already logged in."
			));
		}

		$user = db_query("SELECT id, username FROM user WHERE username = ? and password = ?", array(strtolower($username), $password));

		if (!count($user))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"Invalid username or password."
			));
		}

		session_start();
		$_SESSION['id'] = $user[0]['id'];
		$_SESSION['username'] = $user[0]['username'];

		return array('success'=>true);
	}

	public static function logout()
	{
		session_start();
		session_unset();
		session_destroy();
		return array('success'=>true);
	}

	public static function register($username, $password, $confirm_password, $invitation_code = null)
	{
		if (isset($_SESSION['id']))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"Already logged in."
			));
		}

		// username starts/ends with alphanumeric, 5-20 chars
		$username = trim($username);
		if (!preg_match('/[a-z]{1}[a-z0-9._-]{3,18}[a-z0-9]{1}$/', $username))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>'Invalid username.'
			));
		}

		$usercheck = db_query("SELECT username FROM user WHERE username = ?", array($username));

		if (count($usercheck))
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"Username is already taken."
			));
		}

		// password has no spaces and is 6-32 characters
		if (preg_match('/\s/', $username) || strlen($password) < 6 || strlen($password) > 32)
		{
			return array('success'=>false, 'output'=>array(
				"message"=>'Invalid password.'
			));
		}

		// password has no spaces and is 8-32 characters
		if ($password != $confirm_password)
		{
			return array('success'=>false, 'output'=>array(
				"message"=>"Passwords don't match."
			));
		}

		if (REQUIRE_INVITE)
		{
			$invitecheck = db_query("SELECT * FROM invitation WHERE code = ? AND consumed = 0", array(strtoupper($invitation_code)));

			if (!count($invitecheck))
			{
				return array('success'=>false, 'output'=>array(
					"message"=>"Invalid invite code."
				));
			}
		}

		db_query("INSERT INTO user(username, password) VALUES ( ?, ? )", array($username, $password));
		db_query("DELETE FROM invitation WHERE code = ?", array($invitation_code));

		$user = db_query("SELECT id, username FROM user WHERE username = ?", array($username));

		session_start();
		$_SESSION['id'] = $user[0]['id'];
		$_SESSION['username'] = $user[0]['username'];

		return array('success'=>true);
	}
}

?>
