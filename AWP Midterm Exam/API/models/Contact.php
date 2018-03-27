<?php
class Contact{
 
    // database connection and table name
    private $conn;
    private $table_name = "contactus";
 
    // object properties
    public $id;
    public $email;
    public $subject;
	public $message;
   
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
        $query = "SELECT
                    f.id, f.email,f.subject, f.message
                FROM
                    " . $this->table_name . " f";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    
    function create(){
        
           // query to insert record
           $query = "INSERT INTO
                       " . $this->table_name . "
                   SET
                       email=:email, subject=:subject, message=:message";
        
           // prepare query
           $stmt = $this->conn->prepare($query);
        
           // sanitize
           $this->name=htmlspecialchars(strip_tags($this->email));
          
           $this->description=htmlspecialchars(strip_tags($this->subject));
           $this->category_id=htmlspecialchars(strip_tags($this->message));
          
           
        
           // bind values
           $stmt->bindParam(":email", $this->email);
          
           $stmt->bindParam(":subject", $this->subject);
           $stmt->bindParam(":message", $this->message);
          
           // execute query
           if($stmt->execute()){
               return true;
           }else{
               return false;
           }
       }
       
		function update(){
        
           // query to insert record
           $query = "UPDATE
                   " . $this->table_name . "
                   SET
                       email=:email, subject=:subject, message=:message  
					   WHERE
						id = :id";
        
           // prepare query
           $stmt = $this->conn->prepare($query);
        
           // sanitize
		    $this->id=htmlspecialchars(strip_tags($this->id));
           $this->name=htmlspecialchars(strip_tags($this->email));
          
           $this->description=htmlspecialchars(strip_tags($this->subject));
           $this->category_id=htmlspecialchars(strip_tags($this->message));
          
           
        
           // bind values
		    $stmt->bindParam(":id", $this->id);
           $stmt->bindParam(":email", $this->email);
          
           $stmt->bindParam(":subject", $this->subject);
           $stmt->bindParam(":message", $this->message);
          
           // execute query
           if($stmt->execute()){
               return true;
           }else{
               return false;
           }
       }
	   
	   function delete(){
    
       // delete query
       $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->id=htmlspecialchars(strip_tags($this->id));
    
       // bind id of record to delete
       $stmt->bindParam(1, $this->id);
    
       // execute query
       if($stmt->execute()){
           return true;
       }
    
       return false;
        
   }
   
}