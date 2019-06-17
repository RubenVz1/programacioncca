<?php
	include_once '../includes/user.php';
    include_once '../includes/user_session.php';
    $userSession = new UserSession();
    $user = new User();

	if(isset($_SESSION['user']))
    {
        $user->setUser($userSession->getCurrentUser());
    }
	echo "<p>Bienvenido ".$user->getNombre()."</p>"
?>