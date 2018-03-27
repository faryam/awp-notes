<?php
	class service
	{
		private $host = "localhost";
		private $db_name = "products";
		private $productname = "root";
		private $password = "";
		public $conn;
		public $isValidConnection = false;
		// database connection
		public function getConnection(){
 			$this->conn = null;
			$this->isValidConnection = false;
			try{
				$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->productname, $this->password);
				$this->conn->exec("set names utf8");
				$this->isValidConnection = true;
			}catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
				$this->isValidConnection = false;
			}
		}
		// read product
		function readProducts(){
			//query using PDO
			$query = "SELECT
                    c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
					FROM
						products p
						LEFT JOIN
							categories c
								ON p.category_id = c.id
					ORDER BY
						p.created DESC";
			// prepare query statement
			$stmt = $this->conn->prepare($query);
			// execute query
			$stmt->execute();
			$num = $stmt->rowCount();
			// check if more than 0 record found
			$result;
			if($num>0){
				// products array
				$products_arr=array();
				$products_arr["data"]=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					$product_item=array(
						"id" => $id,
						"name" => $name,
						"description" => html_entity_decode($description),
						"price" => $price,
						"category_id" => $category_id,
						"category_name" => $category_name
					);
					array_push($products_arr["data"], $product_item);
				}
				$products_arr["message"] = "Products loaded successfully";
				$products_arr["status"] = "ok";
				$result = $products_arr;
			}else{
				$result = array(
					"message" => "No products found.",
					"status" => "ok"
				);
			}
			return $result;
		}
		function productRegistration(){
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$sourcePath = $_FILES['productImage']['tmp_name'];       // Storing source path of the file in a variable
				//note upload folder should exists
				$targetPath = "upload/".$_FILES['productImage']['name']; // Target path where file is to be stored
				move_uploaded_file($sourcePath,$targetPath) ;
				$query = "INSERT INTO
					   products SET
					   name=:name, price=:price, productImage=:productImage, description=:description, category_id=:category_id, created=:created , modified=:modified";
				// prepare query
				$stmt = $this->conn->prepare($query);
				// bind values
				$stmt->bindParam(":name", (isset($_POST["name"]))? $_POST["name"] : "empty");
				$stmt->bindParam(":price", (isset($_POST["price"]))? $_POST["price"] : 0);
				$stmt->bindParam(":description", (isset($_POST["description"]))? $_POST["description"] : "empty");
				$stmt->bindParam(":category_id", (isset($_POST["categoryId"]))? $_POST["categoryId"] : 0);
				$stmt->bindParam(":productImage", $targetPath);
				$stmt->bindParam(":created", date('Y-m-d H:i:s'));
				$stmt->bindParam(":modified", date('Y-m-d H:i:s'));
				// execute query
				if($stmt->execute()){
					$result = array(
						"message" => "Product was created.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to create product.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter product name.",
					"status" => "error"
				);
			}
			return $result;
		}
	}
?>