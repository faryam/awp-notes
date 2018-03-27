<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "fooditem";
 
    // object properties
    public $id;
    public $name;
    public $description;
    //public $price;
	public $productImage;
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
                    c.name as category_name, f.foodItemId, f.name, f.description,  f.categoryId, f.createdDate
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

    // create product
	function create(){
		
		   // query to insert record
		   $query = "INSERT INTO
					   " . $this->table_name . "
				   SET
					   name=:name, price=:price, productImage=:productImage, description=:description, category_id=:category_id, created=:created, modified=:modified";
		
		   // prepare query
		   $stmt = $this->conn->prepare($query);
		
		   // sanitize
		   $this->name=htmlspecialchars(strip_tags($this->name));
		   $this->price=htmlspecialchars(strip_tags($this->price));
		   $this->description=htmlspecialchars(strip_tags($this->description));
		   $this->category_id=htmlspecialchars(strip_tags($this->category_id));
		   $this->created=htmlspecialchars(strip_tags($this->created));
		   $this->modified=htmlspecialchars(strip_tags($this->modified));
		
		   // bind values
		   $stmt->bindParam(":name", $this->name);
		   $stmt->bindParam(":price", $this->price);
		   $stmt->bindParam(":description", $this->description);
		   $stmt->bindParam(":productImage", $this->productImage);
		   $stmt->bindParam(":category_id", $this->category_id);
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