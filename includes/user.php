<?php 
include 'db.php';

class User extends DB
{
	private $nombre;
	private $username;
	private $cargo;

	public function userExists($user,$pass)
	{
		$query = $this->connect()->prepare('SELECT *
											FROM Usuarios 
											WHERE username = :user 
											AND password = :pass');
		$query->execute(['user' => $user, 'pass' => $pass]);

		if($query->rowCount())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function setUser($user)
	{
		$query = $this->connect()->prepare('SELECT u.nombre,u.username,t.nombreCargo
											FROM Usuarios u, TipoUsuarios t 
											WHERE u.idTipoUsuario = t.idTipoUsuario
											AND username = :user');
		$query->execute(['user' => $user]);
		foreach($query as $currentUser)
		{
			$this->nombre = $currentUser['nombre'];
			$this->username = $currentUser['username'];
			$this->cargo = $currentUser['nombreCargo'];
		}
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getCargo()
	{
		return $this->cargo;
	}
}

?>