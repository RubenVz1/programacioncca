<?php
    include_once '../includes/user.php';
    include_once '../includes/user_session.php';
    include_once '../includes/db.php';
    include_once '../includes/dbA.php';
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
        <script src="../js/jquery.min.js"></script>
        <title>Calendario</title>
        <link rel="stylesheet" href="../styles/activityStylo.css">
		<link href="../images/icon.ico" type="image/ico" rel="shortcut icon">
    </head>
    <body>
        <header>
            <?php echo "<p>Bienvenido ".$user->getNombre()." con cargo ".$user->getCargo()."</p>"?>
            <a id = "botonRegresar" href="calendar.php">Regresar</a>
            <a id = "botonSalir" href="../includes/logout.php">Cerrar sesion</a>
        </header>
        <form method="post" action="" enctype="multipart/form-data">
        <div id="inicioSesion">
        <?php
            $db = new DB();
            if(isset($_GET['id']))
            {
                function validafecha($fecha)
			    {
				    if($fecha == '0000-00-00')
				    {
				        return 'sin fecha';
				    }
				    else
				    {
				        return $fecha;
				    }
			    }
			         
                $id = $_GET['id'];
                $reqact = $db->connect()->prepare("SELECT * FROM actividad a,programacion b,requerimientoactividad e
                WHERE a.idProgramacion = b.idProgramacion
                AND b.idRequerimientoActividad = e.idRequerimientoActividad
                AND a.idActividad = $id;");
                $reqact->execute();
                $reqact->setFetchMode(PDO::FETCH_NUM);
                $objreqact = $reqact->fetchAll();
                if($reqact->rowCount())
                {//utf8_decode(
                    echo "<h1 id='cabecera'>Requerimientos de Programacion</h1><br>";
                    echo "<p>Fecha de programacion: ".$objreqact[0][10]."</p><br>";
                    echo "<p>Fecha de actividad: ".$objreqact[0][11]."</p><br>";
                    echo "<p>Nombre de la la compañía, grupo, artista, ponente, ciclo, etc: ".$objreqact[0][12]."</p><br>";
                    echo "<p>Nombre de actividad: ".$objreqact[0][13]."</p><br>";
                    echo "<p>Diciplina: ".$objreqact[0][14]."</p><br>";
                    echo "<p>Lugar: ".$objreqact[0][15]."</p><br>";

                    $query1 = $db->connect()->prepare("SELECT h.horario
                                                       FROM actividad a, programacion p, requerimientoactividad r, horario h
                                                       WHERE a.idProgramacion = p.idProgramacion
                                                       AND p.idRequerimientoActividad = r.idRequerimientoActividad
                                                       AND r.idRequerimientoActividad = h.idRequerimientoActividad 
                                                       AND a.idActividad = $id;");
                    $query1->execute();
                    $query1->setFetchMode(PDO::FETCH_NUM);
                    $result1 = $query1->fetchAll();
                    for($i = 0 ; $i < count($result1) ; $i++)
                        echo "<p>Horarios ".($i+1).": ".$result1[$i][0]." hrs</p><br>";
                    if($objreqact[0][16] == 1)
                        echo "<p>tipo de entrada: Libre</p><br>";
                    elseif($objreqact[0][16] == 2)
                        echo "<p>tipo de entrada: Cortesia</p><br>";
                    elseif($objreqact[0][16] == 3)
                    {
                        echo "<p>tipo de entrada: Costo</p><br>";
                        echo "<p>Costo: $".$objreqact[0][17]."</p><br>";
                    }
                    echo "<p>Duracion: ".$objreqact[0][18]." hrs</p><br>";
                    echo "<p>Observacion: ".$objreqact[0][19]."</p><br>";
                    
                
                    $reqdis = $db->connect()->prepare("SELECT * FROM actividad a,programacion b,requerimientodiseno e
                        WHERE a.idProgramacion = b.idProgramacion
                        AND b.idRequerimientodiseno = e.idRequerimientodiseno
                        AND a.idActividad = $id;");
                    $reqdis->execute();
                    $reqdis->setFetchMode(PDO::FETCH_NUM);
                    $objreqdis = $reqdis->fetchAll();
                    
                    echo "<h3>Requerimientos de Diseño</h3><br>";
                    echo "<p>fecha de entrega: ".validafecha($objreqdis[0][10])."</p><br>";
                    $query1 = $db->connect()->prepare("SELECT f.fotografia
                                                      FROM actividad a, programacion p, requerimientodiseno r, fotografia f
                                                      WHERE a.idProgramacion = p.idProgramacion
                                                      AND p.idRequerimientoDiseno = r.idRequerimientoDiseno
                                                      AND f.idRequerimientoDiseno = r.idRequerimientoDiseno 
                                                      AND a.idActividad = $id;");
                    $query1->execute();
                    $query1->setFetchMode(PDO::FETCH_NUM);
                    $result1 = $query1->fetchAll();
                    echo "<strong>Imagenes</strong><br>";
                    for($i = 0 ; $i < count($result1) ; $i++)
                    {
                        echo "<p>Fotografia ".($i+1).":<br><img height='100px' src='".$result1[$i][0]."'/></p><br>";
                        echo "<a href='".$result1[$i][0]."' target='_blank'>".substr($result1[$i][0],18)."</a><br>";
                        if($i != count($result1)-1)
                            echo "<img src='../img/separador.png' height='10px'>";
                    }
                    if (count($result1) == 0)
                    {
                        echo "<i>No hay imágenes</i>";
                    }
                    $query2 = $db->connect()->prepare("SELECT l.logotipo
                                                      FROM actividad a, programacion p, requerimientodiseno r, logotipo l
                                                      WHERE a.idProgramacion = p.idProgramacion
                                                      AND p.idRequerimientoDiseno = r.idRequerimientoDiseno
                                                      AND l.idRequerimientoDiseno = r.idRequerimientoDiseno 
                                                      AND a.idActividad = $id;");
                    $query2->execute();
                    $query2->setFetchMode(PDO::FETCH_NUM);
                    $result2 = $query2->fetchAll();
                    echo "<br><strong>Logos</strong><br>";
                    for($i = 0 ; $i < count($result2) ; $i++)
                    {
                        echo "<p>Fotografia ".($i+1).":<br><img height='100px' src='".$result2[$i][0]."'/></p><br>";
                        echo "<a href='".$result2[$i][0]."' target='_blank'>Click para descargar: ".substr($result2[$i][0],18)."</a><br><br>";
                        if($i != count($result2)-1)
                            echo "<img src='../img/separador.png' height='10px'>";
                    }/*
                    if (count($result3) == 0)
                    {
                        echo "<i>No hay logos</i>";
                    }*/
                    echo "<br><p>Programa de mano: ";
                    if($objreqdis[0][13] == 0)
                        echo "No</p><br>";
                    else
                    {
                        echo"Sí</p><br>";
                        if($objreqdis[0][11] == "")
                            echo "<p>Semblanza compañia: N/A</p><br>";
                        else
                            echo "<p>Semblanza compañia: ".utf8_decode($objreqdis[0][11])."</p><br>";
                        if($objreqdis[0][12] == "")
                            echo "<p>Semblanza actividad: N/A</p><br>";
                        else
                            echo "<p>Semblanza actividad: ".utf8_decode($objreqdis[0][12])."</p><br>";
                    }
                    if($objreqdis[0][14] != "")
                    {
                        echo "<p>PDF:</p>";
                        echo "<input type='image' src='../img/icopdf.ico' width='50px' height='50px'><a href='".$objreqdis[0][14]."' target='_blank'>".substr($objreqdis[0][14],16)."</a><br><br>";
                    }
                    if($objreqdis[0][15] != "")
                    {
                        echo "<p>Word:</p>";
                        echo "<input type='image' src='../img/wordico.ico' width='50px' height='50px'><a href='".$objreqdis[0][15]."' target='_blank'>".substr($objreqdis[0][15],16)."</a><br><br>";
                    }
                    
                    
                    $reqtec = $db->connect()->prepare("SELECT * FROM actividad a,programacion b,requerimientotecnico e
                        WHERE a.idProgramacion = b.idProgramacion
                        AND b.idRequerimientotecnico = e.idRequerimientotecnico
                        AND a.idActividad = $id;");
                    $reqtec->execute();
                    $reqtec->setFetchMode(PDO::FETCH_NUM);
                    $objreqtec = $reqtec->fetchAll();
                    
                    echo "<h3>Requerimientos técnicos</h3><br>";
                    echo "<p>Requerimiento: ".utf8_decode($objreqtec[0][10])."</p><br>";
                    if($objreqtec[0][11] != "")
                    {
                        echo "<p>PDF:</p>";
                        echo "<input type='image' src='../img/icopdf.ico' width='50px' height='50px'><a href='".$objreqtec[0][11]."' target='_blank'>".substr($objreqtec[0][11],16)."</a><br><br>";
                    }
                    if($objreqtec[0][12] != "")
                    {
                        echo "<p>Word:</p>";
                        echo "<input type='image' src='../img/wordico.ico' width='50px' height='50px'><a href='".$objreqtec[0][12]."' target='_blank'>".substr($objreqtec[0][12],16)."</a><br><br>";
                    }
                    
                    
                    $fase2 = $db->connect()->prepare("SELECT * FROM actividad a,diseno b,fase2 e
                        WHERE a.idDiseno = b.iddiseno
                        AND b.idfase2 = e.idfase2
                        AND a.idActividad = $id;");
                    $fase2->execute();
                    $fase2->setFetchMode(PDO::FETCH_NUM);
                    $objfase2 = $fase2->fetchAll();
                    
                    $query3 = $db->connect()->prepare("SELECT c.direccionPdf FROM requerimientodiseno c, actividad a, programacion b 
                        WHERE a.idProgramacion = b.idProgramacion
                        AND b.idRequerimientoDiseno = c.idRequerimientoDiseno
                        AND a.idActividad = $id;");
                    $query3->execute();
                    $query3->setFetchMode(PDO::FETCH_NUM);
                    $result3 = $query3->fetchAll();
                    
                    echo "<h1 id='cabecera'>Diseño</h1><br>";
                    echo "<p>Nombre del diseñador: ".$objfase2[0][9]."</p><br>";
                    echo "<p>fecha de entrega al diseñador: ".validafecha($objfase2[0][10])."</p><br>";
                    echo "<p>fecha de entrega del diseñador: ".validafecha($objfase2[0][11])."</p><br>";
                    echo "<p>cartel: ";
                    if($objfase2[0][12] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>web: ";
                    if($objfase2[0][13] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>cortesia: ";
                    if($objfase2[0][14] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>programa: ";
                    if($objfase2[0][15] == 0)echo "No";
                    else echo "Sí";
                    echo "</p><br>";
                    echo "<p>invitacion: ";
                    if($objfase2[0][16] == 0)echo "No<br>";
                    else echo "Sí <br>";
                    
                    $query4 = $db->connect()->prepare("SELECT d.direccion FROM disenopersonal d, actividad a, diseno b , fase2 c
                        WHERE a.idDiseno = b.idDiseno
                        AND b.idFase2 = c.idFase2
                        AND c.idFase2 = d.idFase2
                        AND a.idActividad = $id;");
                    $query4->execute();
                    $query4->setFetchMode(PDO::FETCH_NUM);
                    $result4 = $query4->fetchAll();
                    
                    echo "<br><p style='font-size: 20px;'><strong>Diseños: <i>".count($result4)."</i></strong></p><br>";
                    
                    if(count($result4) > 0)
                    {
                        for($i = 0 ; $i < count($result4) ; $i++)
                        {
                            $nodiseno = $i+1;
                            if(substr($result4[$i][0],-3) == "pdf")
                            {
                                echo "<p><b>Diseño $nodiseno :</b></p><br><input type='image' src='../img/icopdf.ico' href='".$result4[$i][0]."' target='_blank' width='50px' height='50px'><br><a href='".$result4[$i][0]."' target='_blank'>".substr($result4[$i][0],19)."</a><br><br>";
                                echo "<p style='color: red;'>Eliminar: <input type='checkbox' name='elimina".$nodiseno."' id=''></p><br><br>";
                            }
                            else
                            {
                                echo "<p><b>Diseño $nodiseno :</b></p><br><input type='image' src='".$result4[$i][0]."' href='".$result4[$i][0]."' target='_blank' width='50px' height='50px'><br><a href='".$result4[$i][0]."' target='_blank'>".substr($result4[$i][0],19)."</a><br><br>";
                                echo "<p style='color: red;'>Eliminar: <input type='checkbox' name='elimina".$nodiseno."' id=''></p><br><br>";

                            }
                        }
                        echo "<br><input type='submit' name='eliminardis' id='eliminardis' value='Eliminar'><br><br>";
                    }
                    else
                    {
                        echo "<p>No se han subido diseños</p><br>";
                    }
                    
                    echo "<br><p><b><i>Añadir diseño</i></b></p><br>";
					echo "<input id='masImagenes' name='masImagenes' type='button'value='+'>";
					echo "<input id='menosImagenes' name='menosImagenes' type='button' value='--'><br>";
					echo "<div id='imagenes'>";
                    echo "</div>";
                    echo "<input type='hidden' name='numeroImagenes' id='numeroImagenes' value='0' size='1' ><br>";


                    $cartelycortesias = $db->connect()->prepare("SELECT * FROM actividad a,diseno b,cartelycortesias e
                        WHERE a.idDiseno = b.iddiseno
                        AND b.idcartelycortesias = e.idcartelycortesias
                        AND a.idActividad = $id;");
                    $cartelycortesias->execute();
                    $cartelycortesias->setFetchMode(PDO::FETCH_NUM);
                    $objcartelycortesias = $cartelycortesias->fetchAll();
                
                    echo "</p><br>";
                    echo "<h3>Cartel y cortesias</h3><br>";
                    echo "<p>Digital: ".validafecha($objcartelycortesias[0][9])."</p><br>";

                    echo "<p>offset: ".validafecha($objcartelycortesias[0][10])."</p><br>";
                    echo "<p>Serigrafía: ".validafecha($objcartelycortesias[0][11])."</p><br>";
                    echo "<p>Por fuera: ".validafecha($objcartelycortesias[0][12])."</p><br>";
                    echo "<p>Entrega de programa de mano: ".validafecha($objcartelycortesias[0][13])."</p><br>";
                    echo "<p>invitacion: ".validafecha($objcartelycortesias[0][14])."</p><br>";
                    echo "<p>volante: ".validafecha($objcartelycortesias[0][15])."</p><br>";
                    
                    
                     $corrector = $db->connect()->prepare("SELECT * FROM actividad a,diseno b,corrector e
                        WHERE a.idDiseno = b.iddiseno
                        AND b.idcorrector = e.idcorrector
                        AND a.idActividad = $id;");
                    $corrector->execute();
                    $corrector->setFetchMode(PDO::FETCH_NUM);
                    $objcorrector = $corrector->fetchAll();
                
                    
                    echo "<h3>Corrector</h3><br>";
                    echo "<p>Nombre corrector: ".utf8_decode(utf8_encode($objcorrector[0][10]))."</p><br>";
                    echo "<p>fecha de entrega al corrector: ".validafecha($objcorrector[0][11])."</p><br>";
                    echo "<p>fecha de entrega del corrector: ".validafecha($objcorrector[0][9])."</p><br>";
                    
                    $difusion = $db->connect()->prepare("SELECT * FROM actividad a,difusion b
                        WHERE a.idDifusion = b.iddifusion
                        AND a.idActividad = $id;");
                    $difusion->execute();
                    $difusion->setFetchMode(PDO::FETCH_NUM);
                    $objdifusion = $difusion->fetchAll();
                    
                    echo "<h1 id='cabecera'>Difusion</h1><br>";
                    echo "<p>Fecha difusion: ".validafecha($objdifusion[0][5])."</p><br>";
                    
                    function gettipo($archivo)
                    {
                        $tipo = substr($archivo, -3);
                        if($tipo == "pdf")
                        {
                            return "pdf";
                        }
                        if($tipo == "jpg")
                        {
                            return "jpg";
                        }
                        $tipo = substr($archivo, -4);
                        if($tipo == "jpeg")
                        {
                            return "jpeg";
                        }
                    }
                    function generateRandomString($length = 6)
                    {
                        $possibleChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $id = '';
                        for($i = 0; $i < $length; $i++)
                        {
                            $rand = rand(0, strlen($possibleChars) - 1);
                            $id .= substr($possibleChars, $rand, 1);
                        }
                        return $id;
                    }
                    function insertpdf($nombre,$idfase2)
                    {
                        $direccionPdf ='';
                        if($_FILES[$nombre]['tmp_name'])
				        {
                            $disenoPdf = $_FILES[$nombre]['name'];
                            $direccionPdf = "../disenos/".generateRandomString()."__".$disenoPdf;
					        move_uploaded_file($_FILES[$nombre]['tmp_name'],$direccionPdf);
				        }
				        else
				        {
				        	$direccionPdf ="";
                        }

                        $direccionPdf = utf8_decode($direccionPdf);
                        $mysqli2 = new DBA();
                        $conexion2 = $mysqli2->connect();
                        $sql2 = "INSERT INTO `disenopersonal`(`direccion`, `idFase2`) VALUES ('$direccionPdf',$idfase2)";
                        $resultado2 = $conexion2->query($sql2);
        
                        if($resultado2)
                        {
                            echo "<script>alert('Se subió ".$_FILES[$nombre]['name']."');</script>";
                        }
                        else
                        {
                            echo "<script>alert('error');</script>";
                            die("Error al insertar datos: " . $conexion2->error);
                        }

                    }
                    function insertjpg($nombre,$idfase2)
                    {
						if($_FILES[$nombre]['tmp_name'])
						{
                            //echo "<script>alert('$nombre,$idfase2 img');</script>";
							$imagen = "../disenos/".generateRandomString()."__".$_FILES[$nombre]['name'];
							move_uploaded_file($_FILES[$nombre]['tmp_name'],$imagen);
                            $imagen = utf8_decode($imagen);
                            $mysqli2 = new DBA();
                            $conexion2 = $mysqli2->connect();
                            $sql2 = "INSERT INTO `disenopersonal`(`direccion`, `idFase2`) VALUES ('$imagen',$idfase2)";
                            $resultado2 = $conexion2->query($sql2);
        
                            if($resultado2)
                            {
                                echo "<script>alert('Se subió ".$_FILES[$nombre]['name']."');</script>";
                            }
                            else
                            {
                                echo "<script>alert('error');</script>";
                                die("Error al insertar datos: " . $conexion2->error);
                            }
                        }
                        
                    }
                }
                if(isset($_POST['agrega'])||isset($_POST['eliminardis']))
                {
                        if(isset($_POST['agrega']))
                        {
                            $query5 = $db->connect()->prepare("SELECT c.idFase2 FROM actividad a, diseno b , fase2 c
                        WHERE a.idDiseno = b.idDiseno
                        AND b.idFase2 = c.idFase2
                        AND a.idActividad = $id;");
                        $query5->execute();
                        $query5->setFetchMode(PDO::FETCH_NUM);
                        $result5 = $query5->fetchAll();

                        $idfase2 = $result5[0][0];

                        $numeroImagenes = $_POST['numeroImagenes'];
                        //echo "<script>alert('$numeroImagenes');</script>";


                        for($i = 0; $i < $numeroImagenes; $i++)
                        {   
                            $numeroinput = "archivo".$i;
                            //echo "<script>alert('$numeroImagenes');</script>";
                            if(gettipo($_FILES[$numeroinput]['name']) == "pdf")
                            {
                                //echo "<script>alert('$numeroinput,$idfase2 pdf');</script>";
                                insertpdf($numeroinput,$idfase2);
                                //echo "<script>alert('".$_FILES[$numeroinput]['name']." pdf');</script>";
                            }
                            //echo "<script>alert('".$_FILES[$numeroinput]['name']."');</script>";

                            if(gettipo($_FILES[$numeroinput]['name']) == "jpeg")
                            {
                                //echo "<script>alert('$numeroinput,$idfase2 pdf');</script>";
                                insertjpg($numeroinput,$idfase2);
                                //echo "<script>alert('".$_FILES[$numeroinput]['name']." imagen');</script>";
                            }
                            if(gettipo($_FILES[$numeroinput]['name']) == "jpg")
                            {
                                //echo "<script>alert('$numeroinput,$idfase2 pdf');</script>";
                                insertjpg($numeroinput,$idfase2);
                                //echo "<script>alert('".$_FILES[$numeroinput]['name']." imagen');</script>";
                            }

                            }
                        }
                        if(isset($_POST['eliminardis']))
                        {
                            for($i=0;$i<count($result4);$i++)
                            {
                                $auxn = "elimina".($i+1);
                                if(!empty($_POST[$auxn]))
                                {
                                    unlink($result4[$i][0]);

                                    $sql = "DELETE FROM `disenopersonal` WHERE `direccion` ='".utf8_encode($result4[$i][0])."'";
                                    $query5 = $db->connect()->prepare($sql);
                                    $query5->execute();
                                }
                            }
                        }
                        
                        header("location: ../vistas/activity.php?id=".$_GET['id']);
                }
            }
            else
            {
                echo "<script> alert('Hubo un error al cargar la actividad';</script>";
                header("location: ../vistas/calendar.php");
            }
        ?>
        </div>
        </form>
        <script src="../js/activity.js"></script>
    </body>

</html>