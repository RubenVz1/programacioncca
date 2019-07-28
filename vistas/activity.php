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
        <div id="cabecera">Actividad</div>
        <div id="inicioSesion">
        <?php
            $db = new DB();
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $query = $db->connect()->prepare("SELECT /*a.idActividad,r.nombreActividad,r.fechaProgramacion*/ *
                                                  FROM actividad a, programacion p, requerimientoActividad r
                                                  WHERE a.idProgramacion = p.idProgramacion
                                                  AND p.idRequerimientoActividad = r.idRequerimientoActividad
                                                  AND a.idActividad = $id");
                $query->execute();
                $query->setFetchMode(PDO::FETCH_NUM);
                $result = $query->fetchAll();
                if($query->rowCount())
                {
                    /*for($i = 10;$i <20;$i++)
                    echo "<p>".$result[0][$i]."</p><br>";*/
                    
                    echo "<p>Fecha de programacion: ".$result[0][10]."</p><br>";
                    echo "<p>Fecha de actividad: ".$result[0][11]."</p><br>";
                    echo "<p>Nombre de la la compañía, grupo, artista, ponente, ciclo, etc: ".$result[0][12]."</p><br>";
                    echo "<p>Nombre de actividad: ".$result[0][13]."</p><br>";
                    echo "<p>Diciplina: ".$result[0][14]."</p><br>";
                    echo "<p>Lugar: ".$result[0][15]."</p><br>";
                    echo "<p>horario: ".$result[0][16]."</p><br>";
                    echo "<p>tipo de entrada: ".$result[0][17]."</p><br>";
                    echo "<p>Costo: $".$result[0][18]."</p><br>";
                    echo "<p>Duracion: ".$result[0][19]."hrs</p><br>";

                    
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
        </div>
    </body>
</html>