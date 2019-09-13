<?php
include_once '../includes/db.php';
$db = new DB();
if(isset($_GET['id']))
{
	$query = $db->connect()->prepare('SELECT a.idProgramacion, p.idRequerimientoActividad, p.idRequerimientoDiseno, p.idRequerimientoTecnico, p.idRequerimientoPago
									FROM actividad a, programacion p
									WHERE a.idProgramacion = p.idProgramacion 
									AND a.idActividad ='.$_GET['id']);
	$query->execute();
	$result = $query->fetchAll();
	if($query->rowCount())
	{
		$query = $db->connect()->prepare('DELETE FROM requerimientoPago WHERE idRequerimientoPago ='.$result[0][4]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientoTecnico WHERE idRequerimientoTecnico ='.$result[0][3]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientoDiseno WHERE idRequerimientoDiseno ='.$result[0][2]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM requerimientoActividad WHERE idRequerimientoActividad ='.$result[0][1]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM programacion WHERE idProgramacion ='.$result[0][0]);
		$query->execute();
		$query = $db->connect()->prepare('DELETE FROM actividad WHERE idActividad ='.$_GET['id']);
		$query->execute();
	}
}
?>