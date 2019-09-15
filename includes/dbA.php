<?php

class DBA
{
	private $host;
	private $db;
	private $user;
	private $password;
	private $charset;

	public function __construct()
	{
		$this->host = 'localhost';
		$this->db = 'prueba';
		$this->user = 'root';
		$this->password = 'QQWWEERR1';
	}

	public function connect()
	{
		$conexion = new mysqli($this->host,$this->user,$this->password,$this->db);
		return $conexion;
	}
}
?>