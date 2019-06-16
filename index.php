<?php

	include_once 'includes/user.php';
	include_once 'includes/user_session.php';
	$userSession = new userSession();
	$user = new User();

	if(isset($_SESSION['user']))
	{
		$user->setUser($userSession->getCurrent());
		include_once 'vistas/home.php';
	}
	else if(isset($_POST['username']) && isset($_POST['password']))
	{
		$userForm = $_POST['username'];
		$passForm = $_POST['password'];
		if($user->userExists($userForm,$passForm))
		{
			//echo "index.php dice: se valido el usuario<br>";
			$userSession->setCurrentUser($userForm);
			$user->setUser($userForm,$passForm);
			include_once 'vistas/home.php';
		}
		else
		{
			$errorLogin = "index.php dice: no se valido el usuario<br>";
			include_once 'vistas/login.php';
		}
	}
	else
	{
		//echo "index.php dice: debes ir a login<br>";
		include_once 'vistas/login.php';
	}
?>