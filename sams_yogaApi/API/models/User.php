<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $name;
    public $email;
  	public $token;
  	public $password;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function login(){
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
        $query = "SELECT
                      u.name,
                      u.token
                  FROM
                      " . $this->table_name . " u
                  WHERE
                      u.email = ? AND PASSWORD = ?
                  LIMIT 0, 1";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $pass=md5($this->password);
       $stmt->bindParam(1, $this->email);
       $stmt->bindParam(2, $pass);
        
        // execute query
        $stmt->execute();

        $num = $stmt->rowCount();
        if($num>0){
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $this->name=$row['name'];
          $this->token=$row['token'];
          return 1;
        
      }
      else
      {
        return 0;
      }
        
        
    }

    function validateToken(){
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
        $query = "SELECT
                      u.name
                  FROM
                      " . $this->table_name . " u
                  WHERE
                      u.token = ?
                  LIMIT 0, 1";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        
       $stmt->bindParam(1, $this->token);
       
        
        // execute query
        $stmt->execute();

        $num = $stmt->rowCount();
        if($num>0){
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $this->name=$row['name'];
          
          return 1;
        
      }
      else
      {
        return 0;
      }
        
        
    }



    

   
}