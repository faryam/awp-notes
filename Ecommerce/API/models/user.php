<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $userId;
    public $name;
    public $email;
    public $password;
    public $userImage;
    public $created;
    public $modified;
	
	
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
function signUp(){
    
       // query to insert record
       $query = "INSERT INTO
                   " . $this->table_name . "
               SET
                   name=:name, email=:email, password=:password, userImage=:userImage, created=:created , modified=:modified";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
		
       // sanitize
       $this->name=htmlspecialchars(strip_tags($this->name));
       $this->email=htmlspecialchars(strip_tags($this->email));
       $this->password=htmlspecialchars(strip_tags($this->password));
       $this->userImage=htmlspecialchars(strip_tags($this->userImage));
       $this->created=htmlspecialchars(strip_tags($this->created));
	   $this->modified=htmlspecialchars(strip_tags($this->modified));
    
       // bind values
       $stmt->bindParam(":name", $this->name);
       $stmt->bindParam(":email", $this->email);
       $stmt->bindParam(":password", $this->password);
       $stmt->bindParam(":userImage", $this->userImage);
       $stmt->bindParam(":created", $this->created);
	   $stmt->bindParam(":modified", $this->modified);
    
       // execute query
       if($stmt->execute()){
           return true;
       }else{
           return false;
       }
   }
}