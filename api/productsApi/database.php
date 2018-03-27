<?php

/**
* 
*/
class DataBaseConnection 
{

	private $host = "localhost";
	private $db_name = "wadproject";
	private $username = "root";
	private $password = "";
	public $conn;
	
	public function getConnection(){

		$this->conn = null;

		$conn = new mysqli($this->host,$this->username ,$this->password ,$this->db_name);

		if($conn->connect_error)
		{
			die ("COnnection failed: " . $conn->connect_error);
		}
		$this->conn=$conn;
		return $this->conn;
	}
}