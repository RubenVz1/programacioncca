<?php

class UserSession
{
	public function __contruct()
	{
		session_start();
	}

	public function setCurrentUser($user)
	{
		$_SESSION['user'] = $user;
	}

	public function getCurrentUser()
	{
		return $_SESSION['user'];
	}

	public function closeSession()
	{
		session_unset();
		session_destroy();
	}
}
?>