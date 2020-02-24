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
<?php include 'header.php' ?>
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <div class="section-menu__container activity__container mb-3">
                    <?php
                        $db = new DB();
                        if(isset($_GET['id']))
                        {
                            function validafecha($fecha)
                            {
                                if($fecha == '0000-00-00')
                                    return 'sin fecha';
                                else
                                    return $fecha;
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
                                echo "
                                <div class='section-menu__header text-center py-0'>
                                    <h1>Requerimientos de Programacion</h1>
                                </div>
                                <div class='section-menu__body activity-menu__container'>
                                ";
                                echo "<p>Fecha de programacion: ".$objreqact[0][10]."</p>";
                                echo "<p>Fecha de actividad: ".$objreqact[0][11]."</p>";
                                echo "<p>Nombre de la la compañía, grupo, artista, ponente, ciclo, etc: ".$objreqact[0][12]."</p>";
                                echo "<p>Nombre de actividad: ".$objreqact[0][13]."</p>";
                                echo "<p>Diciplina: ".$objreqact[0][14]."</p>";
                                echo "<p>Lugar: ".$objreqact[0][15]."</p>";
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
                                    echo "<p>Horarios ".($i+1).": ".$result1[$i][0]." hrs</p>";
                                if($objreqact[0][16] == 1)
                                    echo "<p>tipo de entrada: Libre</p>";
                                elseif($objreqact[0][16] == 2)
                                    echo "<p>tipo de entrada: Cortesia</p>";
                                elseif($objreqact[0][16] == 3)
                                {
                                    echo "<p>tipo de entrada: Costo</p>";
                                    echo "<p>Costo: $".$objreqact[0][17]."</p>";
                                }
                                echo "<p>Duración: ".$objreqact[0][18]." hrs</p>";
                                echo "<p>Observación: ".$objreqact[0][19]."</p>";
                                $reqdis = $db->connect()->prepare("SELECT * FROM actividad a,programacion b,requerimientodiseno e
                                    WHERE a.idProgramacion = b.idProgramacion
                                    AND b.idRequerimientodiseno = e.idRequerimientodiseno
                                    AND a.idActividad = $id;");
                                $reqdis->execute();
                                $reqdis->setFetchMode(PDO::FETCH_NUM);
                                $objreqdis = $reqdis->fetchAll();
                                echo "</div></div><div class='section-menu__container activity__container mb-3'>";
                                echo "
                                <div class='section-menu__header text-center py-0'>
                                    <h1>Requerimientos de Diseño</h1>
                                </div>
                                <div class='section-menu__body activity-menu__container'>
                                ";
                                echo "<p>fecha de entrega: ".validafecha($objreqdis[0][10])."</p>";
                                $query1 = $db->connect()->prepare("SELECT f.fotografia
                                                                FROM actividad a, programacion p, requerimientodiseno r, fotografia f
                                                                WHERE a.idProgramacion = p.idProgramacion
                                                                AND p.idRequerimientoDiseno = r.idRequerimientoDiseno
                                                                AND f.idRequerimientoDiseno = r.idRequerimientoDiseno 
                                                                AND a.idActividad = $id;");
                                $query1->execute();
                                $query1->setFetchMode(PDO::FETCH_NUM);
                                $result1 = $query1->fetchAll();
                                echo "<strong>Imagenes</strong>";
                                for($i = 0 ; $i < count($result1) ; $i++)
                                {
                                    echo "<p>Fotografía ".($i+1).":<img height='100px' src='".$result1[$i][0]."'/></p>";
                                    echo "<a href='".$result1[$i][0]."' target='_blank'>".substr($result1[$i][0],18)."</a>";
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
                                echo "<strong>Logos</strong>";
                                for($i = 0 ; $i < count($result2) ; $i++)
                                {
                                    echo "<p>Fotografia ".($i+1).":<img height='100px' src='".$result2[$i][0]."'/></p>";
                                    echo "<a href='".$result2[$i][0]."' target='_blank'>Click para descargar: ".substr($result2[$i][0],18)."</a>";
                                    if($i != count($result2)-1)
                                        echo "<img src='../img/separador.png' height='10px'>";
                                }
                                echo "<p>Programa de mano: ";
                                if($objreqdis[0][13] == 0)
                                    echo "No</p>";
                                else
                                {
                                    echo"Sí</p>";
                                    if($objreqdis[0][11] == "")
                                        echo "<p>Semblanza compañia: N/A</p>";
                                    else
                                        echo "<p>Semblanza compañia: ".utf8_decode($objreqdis[0][11])."</p>";
                                    if($objreqdis[0][12] == "")
                                        echo "<p>Semblanza actividad: N/A</p>";
                                    else
                                        echo "<p>Semblanza actividad: ".utf8_decode($objreqdis[0][12])."</p>";
                                }
                                if($objreqdis[0][14] != "")
                                {
                                    echo "<p>PDF:</p>";
                                    echo "<input type='image' src='../img/icopdf.ico' width='50px' height='50px'><a href='".$objreqdis[0][14]."' target='_blank'>".substr($objreqdis[0][14],16)."</a>";
                                }
                                if($objreqdis[0][15] != "")
                                {
                                    echo "<p>Word:</p>";
                                    echo "<input type='image' src='../img/wordico.ico' width='50px' height='50px'><a href='".$objreqdis[0][15]."' target='_blank'>".substr($objreqdis[0][15],16)."</a>";
                                }
                                $reqtec = $db->connect()->prepare("SELECT * FROM actividad a,programacion b,requerimientotecnico e
                                    WHERE a.idProgramacion = b.idProgramacion
                                    AND b.idRequerimientotecnico = e.idRequerimientotecnico
                                    AND a.idActividad = $id;");
                                $reqtec->execute();
                                $reqtec->setFetchMode(PDO::FETCH_NUM);
                                $objreqtec = $reqtec->fetchAll();
                                echo "</div></div><div class='section-menu__container activity__container mb-3'>";
                                echo "
                                <div class='section-menu__header text-center py-0'>
                                    <h1>Requerimientos técnicos</h1>
                                </div>
                                <div class='section-menu__body activity-menu__container'>";
                                echo "<p>Requerimiento: ".utf8_decode($objreqtec[0][10])."</p>";
                                if($objreqtec[0][11] != "")
                                {
                                    echo "<p>PDF:</p>";
                                    echo "<input type='image' src='../img/icopdf.ico' width='50px' height='50px'><a href='".$objreqtec[0][11]."' target='_blank'>".substr($objreqtec[0][11],16)."</a>";
                                }
                                if($objreqtec[0][12] != "")
                                {
                                    echo "<p>Word:</p>";
                                    echo "<input type='image' src='../img/wordico.ico' width='50px' height='50px'><a href='".$objreqtec[0][12]."' target='_blank'>".substr($objreqtec[0][12],16)."</a>";
                                }
                                
                                $reqpag = $db->connect()->prepare("SELECT * FROM actividad a,programacion b,requerimientopago e
                                    WHERE a.idProgramacion = b.idProgramacion
                                    AND b.idRequerimientopago = e.idRequerimientopago
                                    AND a.idActividad = $id;");
                                $reqpag->execute();
                                $reqpag->setFetchMode(PDO::FETCH_NUM);
                                $objreqpag = $reqpag->fetchAll();
                                echo "</div></div><div class='section-menu__container activity__container mb-3'>";
                                echo "
                                <div class='section-menu__header text-center py-0'>
                                    <h1>Requerimientos de pago</h1>
                                </div>
                                <div class='section-menu__body activity-menu__container'>";
                                echo "<p>Requerimiento: ".utf8_decode($objreqpag[0][10])."</p>";
                                echo "<p>Fecha de documentación: ".validafecha($objreqpag[0][11])."</p>";
                                echo "<p>Fecha tentativa de pago: ".validafecha($objreqpag[0][12])."</p>";
                                if($objreqpag[0][13] != "")
                                {
                                    echo "<p>PDF:</p>";
                                    echo "<input type='image' src='../img/icopdf.ico' width='50px' height='50px'><a href='".$objreqpag[0][13]."' target='_blank'>".substr($objreqpag[0][13],16)."</a>";
                                }
                                if($objreqpag[0][15] != "")
                                {
                                    echo "<p>Word:</p>";
                                    echo "<input type='image' src='../img/wordico.ico' width='50px' height='50px'><a href='".$objreqpag[0][15]."' target='_blank'>".substr($objreqpag[0][15],16)."</a>";
                                }
                                if($objreqpag[0][14] != "")
                                {
                                    echo "<p>Fotografía:<img height='100px' src='".$objreqpag[0][14]."'/></p>";
                                    echo "<a href='".$objreqpag[0][14]."' target='_blank'>Click para descargar: ".substr($objreqpag[0][14],18)."</a>";
                                }
                                $fase2 = $db->connect()->prepare("SELECT * FROM actividad a,diseno b,fase2 e
                                    WHERE a.idDiseno = b.iddiseno
                                    AND b.idfase2 = e.idfase2
                                    AND a.idActividad = $id;");
                                $fase2->execute();
                                $fase2->setFetchMode(PDO::FETCH_NUM);
                                $objfase2 = $fase2->fetchAll();
                                echo "</div></div><div class='section-menu__container activity__container mb-3'>";
                                echo "
                                <div class='section-menu__header text-center py-0'>
                                    <h1>Diseño</h1>
                                </div>
                                <div class='section-menu__body activity-menu__container'>";
                                echo "<p>Nombre del diseñador: ".$objfase2[0][9]."</p>";
                                echo "<p>fecha de entrega al diseñador: ".validafecha($objfase2[0][10])."</p>";
                                echo "<p>fecha de entrega del diseñador: ".validafecha($objfase2[0][11])."</p>";
                                echo "<p>cartel: ";
                                if($objfase2[0][12] == 0)echo "No";
                                else echo "Sí";
                                echo "</p>";
                                echo "<p>web: ";
                                if($objfase2[0][13] == 0)echo "No";
                                else echo "Sí";
                                echo "</p>";
                                echo "<p>cortesía: ";
                                if($objfase2[0][14] == 0)echo "No";
                                else echo "Sí";
                                echo "</p>";
                                echo "<p>programa: ";
                                if($objfase2[0][15] == 0)echo "No";
                                else echo "Sí";
                                echo "</p>";
                                echo "<p>invitación: ";
                                if($objfase2[0][16] == 0)echo "No";
                                else echo "Sí";
                                
                                $query4 = $db->connect()->prepare("SELECT d.direccion FROM disenopersonal d, actividad a, diseno b , fase2 c
                                    WHERE a.idDiseno = b.idDiseno
                                    AND b.idFase2 = c.idFase2
                                    AND c.idFase2 = d.idFase2
                                    AND a.idActividad = $id;");
                                $query4->execute();
                                $query4->setFetchMode(PDO::FETCH_NUM);
                                $result4 = $query4->fetchAll();
                                echo "<strong>Diseños ".count($result4)."</strong>";
                                if(count($result4) > 0)
                                {
                                    for($i = 0 ; $i < count($result4) ; $i++)
                                    {
                                        $nodiseno = $i+1;
                                        if(substr($result4[$i][0],-3) == "pdf")
                                        {
                                            echo "<input type='image' src='../img/icopdf.ico' width='50px' height='50px'><p>Diseño $nodiseno </p><a href='".$result4[$i][0]."' target='_blank'>".substr($result4[$i][0],16)."</a>";
                                        }
                                        else
                                        {
                                            echo "<p>Diseño $nodiseno </p><input type='image' src='".$result4[$i][0]."' width='50px' height='50px'><a href='".$result4[$i][0]."' target='_blank'>".substr($result4[$i][0],16)."</a>";

                                        }
                                    }
                                }
                                else
                                {
                                    echo "<p>No se han subido diseños</p>";
                                }
                                $cartelycortesias = $db->connect()->prepare("SELECT * FROM actividad a,diseno b,cartelycortesias e
                                    WHERE a.idDiseno = b.iddiseno
                                    AND b.idcartelycortesias = e.idcartelycortesias
                                    AND a.idActividad = $id;");
                                $cartelycortesias->execute();
                                $cartelycortesias->setFetchMode(PDO::FETCH_NUM);
                                $objcartelycortesias = $cartelycortesias->fetchAll();
                                echo "</p>";
                                echo "</div></div><div class='section-menu__container activity__container mb-3'>";
                                echo "
                                <div class='section-menu__header text-center py-0'>
                                    <h1>Cartel y cortesías</h1>
                                </div>
                                <div class='section-menu__body activity-menu__container'>";
                                echo "<p>Digital: ".validafecha($objcartelycortesias[0][9])."</p>";

                                echo "<p>offset: ".validafecha($objcartelycortesias[0][10])."</p>";
                                echo "<p>Serigrafía: ".validafecha($objcartelycortesias[0][11])."</p>";
                                echo "<p>Por fuera: ".validafecha($objcartelycortesias[0][12])."</p>";
                                echo "<p>Entrega de programa de mano: ".validafecha($objcartelycortesias[0][13])."</p>";
                                echo "<p>invitación: ".validafecha($objcartelycortesias[0][14])."</p>";
                                echo "<p>volante: ".validafecha($objcartelycortesias[0][15])."</p>";
                                $corrector = $db->connect()->prepare("SELECT * FROM actividad a,diseno b,corrector e
                                    WHERE a.idDiseno = b.iddiseno
                                    AND b.idcorrector = e.idcorrector
                                    AND a.idActividad = $id;");
                                $corrector->execute();
                                $corrector->setFetchMode(PDO::FETCH_NUM);
                                $objcorrector = $corrector->fetchAll();
                                echo "</div></div><div class='section-menu__container activity__container mb-3'>";
                                echo "
                                <div class='section-menu__header text-center py-0'>
                                    <h1>Corrector</h1>
                                </div>
                                <div class='section-menu__body activity-menu__container'>";
                                echo "<p>Nombre corrector: ".utf8_decode(utf8_encode($objcorrector[0][10]))."</p>";
                                echo "<p>fecha de entrega al corrector: ".validafecha($objcorrector[0][11])."</p>";
                                echo "<p>fecha de entrega del corrector: ".validafecha($objcorrector[0][9])."</p>";
                                $difusion = $db->connect()->prepare("SELECT * FROM actividad a,difusion b
                                    WHERE a.idDifusion = b.iddifusion
                                    AND a.idActividad = $id;");
                                $difusion->execute();
                                $difusion->setFetchMode(PDO::FETCH_NUM);
                                $objdifusion = $difusion->fetchAll();
                                echo "</div></div><div class='section-menu__container activity__container mb-5'>";
                                echo "
                                <div class='section-menu__header text-center py-0'>
                                    <h1>Difusión</h1>
                                </div>
                                <div class='section-menu__body activity-menu__container'>";
                                echo "<p>Fecha difusión: ".validafecha($objdifusion[0][5])."</p>";
                                echo "</div></div>";  
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
        </div>    
    </div>
<?php include 'footer.php' ?>