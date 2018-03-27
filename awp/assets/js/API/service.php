<?php
	class service
	{
		// read product
		function readProducts(){
			require('core/database.php');
			require('models/product.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$product = new Product($db);
			 
			// query products
			$stmt = $product->read();
			$num = $stmt->rowCount();
			$result=array();
			// check if more than 0 record found
			if($num>0){
				// products array
				$result["data"]=array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					// extract row
					// this will make $row['name'] to
					// just $name only
					extract($row);
					$product_item=array(
						"id" => $foodItemId,
						"name" => $name,
						"description" => html_entity_decode($description),
						"categoryId" => $categoryId,
						"category_name" => $category_name
					);
					array_push($result["data"], $product_item);
				}
				$result["status"]='ok';
				$result["message"]='Product are loaded successfully';
				
			}else{
				$result["status"]='ok';
				$result["message"]='Product are loaded successfully';
			}
			return $result;
		}
		function productRegistration(){
			$result;
			if(isset($_POST['name']) && !empty($_POST['name'])){
				require('core/database.php');
				require('models/product.php');

				$database = new Database();
				$db = $database->getConnection();
				
				$sourcePath = $_FILES['productImage']['tmp_name'];       // Storing source path of the file in a variable
				//upload folder should exists
				$targetPath = "upload/".$_FILES['productImage']['name']; // Target path where file is to be stored
				move_uploaded_file($sourcePath,$targetPath) ;
				
				$product = new Product($db);
				// get posted data
				$data = json_decode(file_get_contents("php://input"));
				// set product property values
				$product->name = $_POST['name'];
				$product->price = $_POST['price'];
				$product->description = $_POST['description'];
				$product->category_id = $_POST['categoryId'];
				$product->productImage = $targetPath;
				$product->created = date('Y-m-d H:i:s');
				$product->modified = date('Y-m-d H:i:s');
				
				if($product->create()){
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