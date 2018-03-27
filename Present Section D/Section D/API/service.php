<?php
	class service
	{
		private $host = "localhost";
		private $db_name = "articles";
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
                    c.name as category_name, p.articleId, p.title, p.detail, p.categoryId, p.featureImage, p.createdDate
					FROM
						articles p
						LEFT JOIN
							category c
								ON p.categoryId = c.categoryId
					ORDER BY
						p.createdDate DESC";
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
						"id" => $articleId,
						"title" => $title,
						"imageUrl"=>$featureImage,
						"detail" => html_entity_decode($detail),
						"categoryId" => $categoryId,
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
			if(isset($_POST['title']) && !empty($_POST['title'])){
				//print_r($_POST);die();
				
				$sourcePath = $_FILES['featureImage']['tmp_name'];       // Storing source path of the file in a variable
				//note upload folder should exists
				$targetPath = "Upload/".$_FILES['featureImage']['name']; // Target path where file is to be stored
				move_uploaded_file($sourcePath,"../".$targetPath) ;
				$query = "INSERT INTO
					   articles SET
					   title=:title, detail=:detail, categoryId=:categoryId, featureImage=:featureImage, createdDate=:createdDate";
				// prepare query
				$stmt = $this->conn->prepare($query);
				// bind values
				$a=(isset($_POST["title"]))? $_POST["title"] : "empty";
				$stmt->bindParam(":title", $a);
				$b=(isset($_POST["detail"]))? $_POST["detail"] : "empty";
				$stmt->bindParam(":detail", $b);
				$c=(isset($_POST["categoryId"]))? $_POST["categoryId"] : 0;
				$stmt->bindParam(":categoryId", $c);
				$stmt->bindParam(":featureImage", $targetPath);
				$d=date('Y-m-d H:i:s');
				$stmt->bindParam(":createdDate", $d);
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
			}
			else{
				$result = array(
					"message" => "Please enter product name.",
					"status" => "error"
				);
			}
			return $result;
		}
	}
?>