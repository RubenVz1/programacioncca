<?php 
include_once 'db.php';

class USEr extends DB
{
	private $nombre;
	private $username;

	public function userExists($user,$pass)
	{
		$query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
		$query->execute(['user' => $user, 'pass' => $pass]);

		if($query->rowCount())
		{
			//echo "user.php dice: existe el usuario<br>";
			return true;
		}
		//echo "user.php dice: no existe el usuario<br>";
		return false;
	}

	public function setUser($user)
	{
		$query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
		$query->execute(['user' => $user]);
		foreach($query as $currentUser)
		{
			$this->nombre = $currentUser['nombre'];
			$this->username = $currentUser['username'];
		}
	}

	public function getNombre()
	{
		return $this->nombre;
	}
}

?>