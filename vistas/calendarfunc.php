<?php
    function fechaAnterior($anterior)
    {
        if($anterior[0]==1)
        {
            $anterior[0]=12;
            $anterior[1]-=1;
        }
        else
            $anterior[0]-=1;
        if($anterior[0]<10)
            $anterior[0] = "0".$anterior[0];
        return $anterior;
    }
    function fechaSiguiente($siguiente)
    {
        if($siguiente[0]>11)
        {
            $siguiente[0]=1;
            $siguiente[1]+=1;
        }
        else
            $siguiente[0]+=1;
        if($siguiente[0]<10)
            $siguiente[0] = "0".$siguiente[0];
        return $siguiente;
    }
    function fechaString($dia,$mes,$anio)
    {
        if($dia<10)
        {
            $dia = "0".$dia;
        }
        return $anio."-".$mes."-".$dia;
    }
    $nombreMeses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    $fecha = new DateTime();
    $mes = $fecha->format('m');
    $currentmes = $mes-1;
    $anio = $fecha->format('Y');
    $currentdia = $fecha->format('d');
    $siguiente = fechaSiguiente(array($mes,$anio));
    $anterior = fechaAnterior(array($mes,$anio));
    if(isset($_GET['mes'])&&isset($_GET['anio']))
    {
        $siguiente = fechaSiguiente(array($_GET['mes'],$_GET['anio']));
        $anterior = fechaAnterior(array($_GET['mes'],$_GET['anio']));
        $mes = $_GET['mes'];
        $anio = $_GET['anio'];
    }
    $db = new DB();
    $query = $db->connect()->prepare("SELECT a.idActividad,r.nombreCompania,r.fechaEvento
                                    FROM actividad a, programacion p, requerimientoactividad r
                                    WHERE a.idProgramacion = p.idProgramacion
                                    AND p.idRequerimientoActividad = r.idRequerimientoActividad
                                    AND r.fechaEvento >= '$anio-$mes-01'
                                    AND r.fechaEvento <= '$anio-$mes-31'");
    $query->execute();
    $query->setFetchMode(PDO::FETCH_NUM);
    $result = $query->fetchAll();
?>