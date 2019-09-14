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
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Calendario</title>
        <link rel="stylesheet" href="../styles/activityStylo.css">
        <link href="../img/icon.ico" type="image/ico" rel="shortcut icon">
    </head>
    <body>
        <header>
            <?php echo "<p>Bienvenido ".$user->getNombre()." con cargo ".$user->getCargo()."</p>"?>
            <a id = "botonRegresar" href="calendar.php">Regresar</a>
            <a id = "botonSalir" href="../includes/logout.php">Cerrar sesion</a>
        </header>
        <form>
        <div id="inicioSesion">
        <?php
            $db = new DB();
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $query = $db->connect()->prepare("SELECT *
                                                  FROM actividad a, programacion b, diseno c, difusion d, 
                                                  requerimientoActividad e, requerimientodiseno f,
                                                  requerimientotecnico g, requerimientopago h, 
                                                  fase2 i, cartelycortesias j,
                                                  corrector k
                                                  WHERE a.idProgramacion = b.idProgramacion
                                                  AND a.idDiseno = c.iddiseno
                                                  AND a.idDifusion = d.idDifusion
                                                  AND b.idRequerimientoActividad = e.idRequerimientoActividad
                                                  AND b.idRequerimientoDiseno = f.idRequerimientoDiseno
                                                  AND b.idRequerimientoTecnico = g.idRequerimientoTecnico
                                                  AND b.idRequerimientoPago = h.idRequerimientoPago
                                                  and c.idfase2 = i.idfase2
                                                  and c.idcartelycortesias = j.idcartelycortesias
                                                  AND c.idcorrector = k.idcorrector
                                                  AND a.idActividad = $id;
                                                  ");
                $query->execute();
                $query->setFetchMode(PDO::FETCH_NUM);
                $result = $query->fetchAll();
                if($query->rowCount())
                {//utf8_decode(
                    echo "<h1 id='cabecera'>Requerimientos de Programacion</h1><br>";
                    echo "<p>Fecha de programacion: ".$result[0][16]."</p><br>";
                    echo "<p>Fecha de actividad: ".$result[0][17]."</p><br>";
                    echo "<p>Nombre de la la compañía, grupo, artista, ponente, ciclo, etc: ".$result[0][18]."</p><br>";
                    echo "<p>Nombre de actividad: ".$result[0][19]."</p><br>";
                    echo "<p>Diciplina: ".$result[0][20]."</p><br>";
                    echo "<p>Lugar: ".$result[0][21]."</p><br>";

                    $query1 = $db->connect()->prepare("SELECT h.horario
                                                       FROM Actividad a, Programacion p, requerimientoActividad r, horario h
                                                       WHERE a.idProgramacion = p.idProgramacion
                                                       AND p.idRequerimientoActividad = r.idRequerimientoActividad
                                                       AND r.idRequerimientoActividad = h.idRequerimientoActividad 
                                                       AND a.idActividad = $id;");
                    $query1->execute();
                    $query1->setFetchMode(PDO::FETCH_NUM);
                    $result1 = $query1->fetchAll();
                    for($i = 0 ; $i < count($result1) ; $i++)
                        echo "<p>Horarios ".($i+1).": ".$result1[$i][0]."</p><br>";
                    echo "<p>tipo de entrada: ".$result[0][22]."</p><br>";
                    echo "<p>Costo: $".$result[0][23]."</p><br>";
                    echo "<p>Duracion: ".$result[0][24]."hrs</p><br>";
                    echo "<p>Observacion: ".$result[0][25]."</p><br>";
                    echo "<h3>Requerimientos de Diseño</h3><br>";
                    echo "<p>fecha de entrega: ".$result[0][27]."</p><br>";
                    $query1 = $db->connect()->prepare("SELECT f.fotografia
                                                      FROM Actividad a, Programacion p, requerimientoDiseno r, fotografia f
                                                      WHERE a.idProgramacion = p.idProgramacion
                                                      AND p.idRequerimientoDiseno = r.idRequerimientoDiseno
                                                      AND f.idRequerimientoDiseno = r.idRequerimientoDiseno 
                                                      AND a.idActividad = $id;");
                    $query1->execute();
                    $query1->setFetchMode(PDO::FETCH_NUM);
                    $result1 = $query1->fetchAll();
                    echo "<h2>Imagenes</h2><br>";
                    for($i = 0 ; $i < count($result1) ; $i++)
                    {
                        echo "<p>Fotografia ".($i+1).":<br><img height='100px' src='".$result1[$i][0]."'/></p><br>";
                        echo "<a href='".$result1[$i][0]."' target='_blank'>".substr($result1[$i][0],18)."</a><br>";
                        if($i != count($result1)-1)
                            echo "<img src='../img/separador.png' height='10px'>";
                    }
                    $query2 = $db->connect()->prepare("SELECT l.logotipo
                                                      FROM Actividad a, Programacion p, requerimientoDiseno r, logotipo l
                                                      WHERE a.idProgramacion = p.idProgramacion
                                                      AND p.idRequerimientoDiseno = r.idRequerimientoDiseno
                                                      AND l.idRequerimientoDiseno = r.idRequerimientoDiseno 
                                                      AND a.idActividad = $id;");
                    $query2->execute();
                    $query2->setFetchMode(PDO::FETCH_NUM);
                    $result2 = $query2->fetchAll();
                    echo "<br><h2>Logos</h2><br>";
                    for($i = 0 ; $i < count($result2) ; $i++)
                    {
                        echo "<p>Fotografia ".($i+1).":<br><img height='100px' src='".$result2[$i][0]."'/></p><br>";
                        echo "<a href='".$result2[$i][0]."' target='_blank'>Click para descargar: ".substr($result2[$i][0],18)."</a><br><br>";
                        if($i != count($result2)-1)
                            echo "<img src='../img/separador.png' height='10px'>";
                    }
                    if($result[0][28] == "")
                    {
                        echo "<p>Semblanza compañia: N/A</p><br>";
                    }else
                    {//echo html_entity_decode(htmlentities($test))
                        echo "<p>Semblanza compañia: ".utf8_decode($result[0][28])."</p><br>";
                    }
                    echo "<p>Semblanza actividad: ".utf8_decode($result[0][29])."</p><br>";
                    echo "<p>Programa de mano: ";
                    if($result[0][30] == 0)
                    echo "No";
                    else echo"Sí";
                    echo "</p><br>";
                    echo "<h3>Requerimientos técnicos</h3><br>";
                    echo "<p>Requerimiento: ".utf8_decode($result[0][32])."</p><br>";
                    if($result[0][33] != "")
                    {
                        echo "<a href='".$result[0][33]."' target='_blank'>".substr($result[0][33],16)."</a><br><br>";
                    }
                    echo "<h1 id='cabecera'>Diseño</h1><br>";
                    echo "<p>Nombre del diseñador: ".$result[0][39]."</p><br>";
                    echo "<p>fecha de entrega al diseñador: ".$result[0][40]."</p><br>";
                    echo "<p>fotos: ";
                    if($result[0][40] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>viñeta: ";
                    if($result[0][41] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>logos: ";
                    if($result[0][42] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>lugar: ".$result[0][44]."</p><br>";
                    echo "<p>fecha: ".$result[0][45]."</p><br>";
                    echo "<p>hora: ".$result[0][46]."</p><br>";
                    echo "<p>leyenda: ".$result[0][47]."</p><br>";
                    echo "<p>fecha de entrega del diseñador: ".$result[0][48]."</p><br>";
                    echo "<p>cartel: ";
                    if($result[0][48] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>web: ";
                    if($result[0][49] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>cortesia: ";
                    if($result[0][50] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>programa: ";
                    if($result[0][51] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>invitacion: ";
                    if($result[0][52] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<h3>Cartel y cortesias</h3><br>";
                    echo "<p>Digital: ".$result[0][55]."</p><br>";
                    echo "<p>offset: ".$result[0][56]."</p><br>";
                    echo "<p>Serigrafía: ".$result[0][57]."</p><br>";
                    echo "<p>Por fuera: ".$result[0][58]."</p><br>";
                    echo "<p>Entrega de programa de mano: ".$result[0][59]."</p><br>";
                    echo "<p>invitacion: ".$result[0][60]."</p><br>";
                    echo "<p>volante: ".$result[0][61]."</p><br>";
                    echo "<h3>Corrector</h3><br>";
                    echo "<p>Nombre corrector: ".utf8_decode(utf8_encode($result[0][64]))."</p><br>";
                    echo "<p>fecha de entrega al corrector: ".$result[0][63]."</p><br>";
                    echo "<p>fecha de entrega del corrector: ".$result[0][65]."</p><br>";
                    echo "<h1 id='cabecera'>Difusion</h1><br>";
                    echo "<p>Fecha difusion: ".$result[0][14]."</p><br>";  
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
        </form>
    </body>
</html>