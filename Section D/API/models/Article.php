<?php
class Article{
 
    // database connection and table name
    private $conn;
    private $table_name = "articles";
 
    // object properties
    public $id;
    public $name;
    public $description;
	  public $imageUrl;
    public $category_id;
    public $category_name;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // select all query
        $query = "SELECT
                    c.name as category_name, f.articleId, f.title,f.featureImage, f.detail,f.categoryId, f.createdDate
                FROM
                    " . $this->table_name . " f
                    LEFT JOIN
                        category c
                            ON f.categoryId = c.categoryId
                ORDER BY
                    f.createdDate DESC";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    function readOne(){
    
       // query to read single record
       $query = "SELECT
                    c.name as category_name, f.articleId, f.title,f.featureImage, f.detail,f.categoryId, f.createdDate
               FROM
                    " . $this->table_name . " f
                    LEFT JOIN
                        category c
                            ON f.categoryId = c.categoryId
               WHERE
                   f.articleId = ?
               LIMIT
                   0,1";
    
       // prepare query statement
       $stmt = $this->conn->prepare( $query );
    
       // bind id of product to be updated
       $stmt->bindParam(1, $this->id);
    
    
       // execute query
       $stmt->execute();
    
       // get retrieved row
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
       // set values to object properties
       $this->name = $row['title'];
       $this->imageUrl = $row['featureImage'];
       $this->description = $row['detail'];
       $this->category_id = $row['categoryId'];
       $this->category_name = $row['category_name'];
       $this->created = $row['createdDate'];
   }
    function create(){
        
           // query to insert record
           $query = "INSERT INTO
                       " . $this->table_name . "
                   SET
                       title=:name, featureImage=:featureImage, detail=:detail, categoryId=:category_id, createdDate=:created";
        
           // prepare query
           $stmt = $this->conn->prepare($query);
        
           // sanitize
           $this->name=htmlspecialchars(strip_tags($this->name));
          
           $this->description=htmlspecialchars(strip_tags($this->description));
           $this->category_id=htmlspecialchars(strip_tags($this->category_id));
           $this->created=htmlspecialchars(strip_tags($this->created));
           
        
           // bind values
           $stmt->bindParam(":name", $this->name);
          
           $stmt->bindParam(":detail", $this->description);
           $stmt->bindParam(":featureImage", $this->imageUrl);
           $stmt->bindParam(":category_id", $this->category_id);
           $stmt->bindParam(":created", $this->created);
          
        
           // execute query
           if($stmt->execute()){
               return true;
           }else{
               return false;
           }
       }
       function update(){
        
             $query = "UPDATE
                   " . $this->table_name . "
               SET
                   title = :name,
                  featureImage=:imageUrl,
                   detail = :description,
                   categoryId=:category_id
               WHERE
                   articleId = :id";
           // query to insert record
           
        
           // prepare query
           $stmt = $this->conn->prepare($query);
        
           // sanitize
           $this->name=htmlspecialchars(strip_tags($this->name));
          
           $this->description=htmlspecialchars(strip_tags($this->description));
           $this->category_id=htmlspecialchars(strip_tags($this->category_id));
           
            $this->id=htmlspecialchars(strip_tags($this->id));
        
           // bind values
           $stmt->bindParam(":name", $this->name);
          
           $stmt->bindParam(":description", $this->description);
           $stmt->bindParam(":imageUrl", $this->imageUrl);
           $stmt->bindParam(":category_id", $this->category_id);
          
          $stmt->bindParam(':id', $this->id);
        
           // execute query
           if($stmt->execute()){
               return true;
           }else{
               return false;
           }
       }

       function delete(){
    
       // delete query
       $query = "DELETE FROM " . $this->table_name . " WHERE articleId = ?";
    
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