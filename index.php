<?php
    include_once 'includes/user.php';
    include_once 'includes/user_session.php';
    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user']))
    {
        $user->setUser($userSession->getCurrentUser());
        header("location: vistas/home.php");
    }
    else if(isset($_POST['username']) && isset($_POST['password']))
    {
        $userForm = $_POST['username'];
        $passForm = $_POST['password'];
        $user = new User();

        if($user->userExists($userForm, $passForm))
        {
            $userSession->setCurrentUser($userForm);
            $user->setUser($userForm);
            header("location: vistas/home.php");
        }
        else
        {
            $errorLogin = "Nombre de usuario y/o password incorrecto";
            include_once 'vistas/login.php';
        }
    }
    else
    {
        include_once 'vistas/login.php';
    }
?>