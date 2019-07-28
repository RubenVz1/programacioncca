<?php
	include_once '../includes/user.php';
    include_once '../includes/user_session.php';
    include_once '../includes/db.php';
    $userSession = new UserSession();
    $user = new User();
    if(isset($_SESSION['user']))
    {
        $user->setUser($userSession->getCurrentUser());
    }
    else
    {
        header("location: ../index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Calendario</title>
        <link rel="stylesheet" href="../styles/calendarStylo.css">
    </head>
    <body>
        <header>
            <?php echo "<p>Bienvenido ".$user->getNombre()." con cargo ".$user->getCargo()."</p>"?>
            <a id = "botonRegresar" href="calendar.php">Regresar</a>
            <a id = "botonSalir" href="../includes/logout.php">Cerrar sesion</a>
        </header>
        <?php
            $db = new DB();
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $query = $db->connect()->prepare("SELECT a.idActividad,r.nombreActividad,r.fechaProgramacion
                                                  FROM actividad a, programacion p, requerimientoActividad r
                                                  WHERE a.idProgramacion = p.idProgramacion
                                                  AND p.idRequerimientoActividad = r.idRequerimientoActividad
                                                  AND a.idActividad = $id");
                $query->execute();
                $query->setFetchMode(PDO::FETCH_NUM);
                $result = $query->fetchAll();
                if($query->rowCount())
                {
                    echo "<h1>".$result[0][1]."</h1>";
                }
                else
                {
                    echo "Hubo un error al cargar la actividad";
                }
            }
            else
            {
                header("location: ../vistas/calendar.php");
            }
            ?>
    </body>
</html>