<?php
include_once '../includes/db.php';
$db = new DB();
if(isset($_GET['id']))
{
	/*$query = $db->connect()->prepare('SELECT a.idProgramacion, p.idRequerimientoActividad, p.idRequerimientoDiseno, p.idRequerimientoTecnico, p.idRequerimientoPago
									FROM Actividad a, Programacion p
									WHERE a.idProgramacion = p.idProgramacion 
									AND a.idActividad ='.$_GET['id']);*/
	$query = $db->connect()->prepare('SELECT a.idProgramacion, a.idDiseno, a.idDifusion, p.idRequerimientoActividad, q.idDiseno,w.idDifusion,p.idRequerimientoDiseno, p.idRequerimientoTecnico, p.idRequerimientoPago, x.idCartelyCortesias, y.idCorrector,z.idFase2,h.idHorario,t.idRequerimientotecnico
	FROM Actividad a, Programacion p, Difusion w, Diseno q, Cartelycortesias x, Corrector y,fase2 z,horario h,requerimientotecnico t
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
		$query = $db->connect()->prepare('DELETE FROM horario WHERE idRequerimientoActividad ='.$resultActividad[0][12]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM fase2 WHERE idFase2 ='.$resultActividad[0][11]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM corrector WHERE idCorrector ='.$resultActividad[0][10]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM cartelycortesias WHERE idCartelycortesias ='.$resultActividad[0][9]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientoPago WHERE idRequerimientoPago ='.$resultActividad[0][8]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientoTecnico WHERE idRequerimientoTecnico ='.$resultActividad[0][3]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientoDiseno WHERE idRequerimientoDiseno ='.$resultActividad[0][6]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM difusion WHERE idDifusion ='.$resultActividad[0][5]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM diseno WHERE idDiseno ='.$resultActividad[0][1]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientotecnico WHERE idRequerimientotecnico ='.$resultActividad[0][13]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientoActividad WHERE idRequerimientoActividad ='.$resultActividad[0][3]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM Programacion WHERE idProgramacion ='.$resultActividad[0][0]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM Actividad WHERE idActividad ='.$_GET['id']);
		$query->execute();
	}
}
header("location: ../vistas/administracion.php");
?>