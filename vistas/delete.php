<?php
include_once '../includes/db.php';
$db = new DB();
if(isset($_GET['id']))
{
//Elimina las fotografias
	$query2 = $db->connect()->prepare('SELECT h.fotografia
	FROM actividad a, programacion p,requerimientodiseno i, fotografia h
	WHERE a.idProgramacion = p.idProgramacion 
    AND p.idRequerimientoDiseno = i.idRequerimientodiseno
    AND i.idRequerimientodiseno = h.idRequerimientoDiseno
	AND a.idActividad ='.$_GET['id']);
	$query2->execute();
	$resultActividad2 = $query2->fetchAll();
	for($i=0; $i < count($resultActividad2);$i++)
	{
		unlink($resultActividad2[$i][0]);
	}
//elimina los logotipos
	$query3 = $db->connect()->prepare("SELECT l.logotipo
                                                      FROM actividad a, programacion p, requerimientodiseno r, logotipo l
                                                      WHERE a.idProgramacion = p.idProgramacion
                                                      AND p.idRequerimientoDiseno = r.idRequerimientoDiseno
                                                      AND l.idRequerimientoDiseno = r.idRequerimientoDiseno 
													  AND a.idActividad =".$_GET['id']);
	$query3->execute();
	$resultActividad3 = $query3->fetchAll();
	for($i=0;$i<count($resultActividad3);$i++)
	{
		unlink($resultActividad3[$i][0]);
	}			
	
//elimina los pdfs
$query4 = $db->connect()->prepare("SELECT r.direccionPdf
FROM actividad a, programacion p, requerimientotecnico r
WHERE a.idProgramacion = p.idProgramacion
AND p.idRequerimientoTecnico = r.idRequerimientoTecnico
AND a.idActividad =".$_GET['id']);
$query4->execute();
$resultActividad4 = $query4->fetchAll();
for($i=0;$i<count($resultActividad4);$i++)
	{
		unlink($resultActividad4[$i][0]);
	}
//elimina toda la actividad de la BD
	$query = $db->connect()->prepare('SELECT a.idProgramacion, a.idDiseno, a.idDifusion, p.idRequerimientoActividad, q.idDiseno,w.idDifusion,p.idRequerimientoDiseno, p.idRequerimientoTecnico, p.idRequerimientoPago, x.idCartelyCortesias, y.idCorrector,z.idFase2,h.idHorario,t.idRequerimientotecnico
	FROM actividad a, programacion p, difusion w, diseno q, cartelycortesias x, corrector y,fase2 z,horario h,requerimientotecnico t
	WHERE a.idProgramacion = p.idProgramacion 
	AND a.idDifusion = w.idDifusion 
	AND a.idDiseno = q.idDiseno 
	AND q.idCartelyCortesias = x.idCartelyCortesias 
	AND q.idCorrector = y.idCorrector 
	AND q.idFase2 = z.idFase2 
	AND p.idRequerimientoActividad = h.idRequerimientoactividad
	AND p.idRequerimientoTecnico = t.IdRequerimientotecnico
	AND a.idActividad ='.$_GET['id']);
	$query->execute();
	$resultActividad= $query->fetchAll();
	if($query->rowCount())
	{
		$query = $db->connect()->prepare('DELETE FROM horario WHERE idRequerimientoActividad ='.$resultActividad[0][3]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM fase2 WHERE idFase2 ='.$resultActividad[0][11]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM corrector WHERE idCorrector ='.$resultActividad[0][10]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM cartelycortesias WHERE idCartelycortesias ='.$resultActividad[0][9]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientopago WHERE idRequerimientoPago ='.$resultActividad[0][8]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientotecnico WHERE idRequerimientoTecnico ='.$resultActividad[0][7]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientodiseno WHERE idRequerimientoDiseno ='.$resultActividad[0][6]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM difusion WHERE idDifusion ='.$resultActividad[0][5]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM diseno WHERE idDiseno ='.$resultActividad[0][1]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientotecnico WHERE idRequerimientotecnico ='.$resultActividad[0][7]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientoactividad WHERE idRequerimientoActividad ='.$resultActividad[0][3]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM programacion WHERE idProgramacion ='.$resultActividad[0][0]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM actividad WHERE idActividad ='.$_GET['id']);
		$query->execute();
	}
}
header("location: ../vistas/administracion.php");
?>