<?php
	class service
	{
		// read product
		function readFoodItems(){
			require('core/database.php');
			require('models/FoodItem.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$fooditem = new FoodItem($db);
			 
			// query products
			$stmt = $fooditem->read();
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
					$food_item=array(
						"id" => $foodItemId,
						"name" => $name,
						"description" => html_entity_decode($description),
						"imageUrl" => $imageUrl,
						"category_id" => $categoryId,
						"category_name" => $category_name,
						"createdDate"=>$createdDate
					);
					array_push($result["data"], $food_item);
				}
				$result["status"]='ok';
				$result["message"]='Product are loaded successfully';
				
			}else{
				$result["status"]='ok';
				$result["message"]='Product are loaded successfully';
			}
			return $result;
		}
		function foodItemRegistration(){
			$result;
			if(isset($_POST['name']) && !empty($_POST['name'])){
				require('core/database.php');
				require('models/FoodItem.php');

				$database = new Database();
				$db = $database->getConnection();
				
				$sourcePath = $_FILES['food_Image']['tmp_name'];       // Storing source path of the file in a variable
				//upload folder should exists
				
				$targetPath = "assets/img/FoodItems/".$_FILES['food_Image']['name']; // Target path where file is to be stored
				move_uploaded_file($sourcePath,"../".$targetPath) ;
				
				$fooditem = new FoodItem($db);
				// get posted data
				
				// set product property values
				$fooditem->name = $_POST['name'];
				
				$fooditem->description = $_POST['description'];
				$fooditem->category_id = $_POST['food_category'];
				$fooditem->imageUrl = $targetPath;
				$fooditem->created = date('Y-m-d H:i:s');
				
				
				if($fooditem->create()){
					$result = array(
						"message" => "FoodItem was created.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to create FoodItem.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter FoodItem name.",
					"status" => "error"
				);
			}
			return $result;
			
		}
		function readFoodItem()
		{
			require('core/database.php');
			require('models/FoodItem.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$fooditem = new FoodItem($db);
			$fooditem ->id=$_GET['id'];
			// query products
			$fooditem->readOne();

			$food_item=array(
						"id" => $fooditem->id,
						"name" => $fooditem->name,
						"description" => $fooditem->description,
						"imageUrl" =>$fooditem->imageUrl,
						"category_id" =>$fooditem->category_id,
						"category_name" => $fooditem->category_name,
						"createdDate"=>$fooditem->created
					);
			print_r(json_encode($food_item));

		}


		function updatefoodItem(){
			$result;
			if(isset($_POST['name']) && !empty($_POST['name'])){
				require('core/database.php');
				require('models/FoodItem.php');

				$database = new Database();
				$db = $database->getConnection();
				
				$sourcePath = $_FILES['food_Image']['tmp_name'];       // Storing source path of the file in a variable
				//upload folder should exists
				
				$targetPath = "assets/img/FoodItems/".$_FILES['food_Image']['name']; // Target path where file is to be stored
				move_uploaded_file($sourcePath,"../".$targetPath) ;
				
				$fooditem = new FoodItem($db);
				// get posted data
				
				// set product property values
				$fooditem->id = $_POST['id'];
				$fooditem->name = $_POST['name'];
				
				$fooditem->description = $_POST['description'];
				$fooditem->category_id = $_POST['food_category'];
				$fooditem->imageUrl = $targetPath;
				
				
				
				if($fooditem->update()){
					$result = array(
						"message" => "FoodItem was updated.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to update FoodItem.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter FoodItem name.",
					"status" => "error"
				);
			}
			return $result;
			
		}

		function deletefoodItem(){
			$result;
			if(isset($_POST['id']) && !empty($_POST['id'])){
				require('core/database.php');
				require('models/FoodItem.php');

				$database = new Database();
				$db = $database->getConnection();
				
				
				
				$fooditem = new FoodItem($db);
				// get posted data
				
				// set product property values
				$fooditem->id = $_POST['id'];
				
				
				
				
				if($fooditem->delete()){
					$result = array(
						"message" => "FoodItem was deleted.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to delete FoodItem.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter FoodItem id.",
					"status" => "error"
				);
			}
			return $result;
			
		}
		
		function contactRegistration($data){
			$result;
			if(isset($data->email) && !empty($data->email)){
				require('core/database.php');
				require('models/Contact.php');

				$database = new Database();
				$db = $database->getConnection();
				
				
				
				$contact = new Contact($db);
				// get posted data
				
				// set product property values
				$contact->email = $data->email;
				$contact->subject = $data->subject;
				$contact->message = $data->message;
				
				
				
				if($contact->create()){
					$result = array(
						"message" => "Contact was created.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to create Contact.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter Contact email.",
					"status" => "error"
				);
			}
			return $result;
			
		}
		function updateContact($data){
			$result;
			if(isset($data->email) && !empty($data->email)){
				require('core/database.php');
				require('models/Contact.php');

				$database = new Database();
				$db = $database->getConnection();
				
				
				
				$contact = new Contact($db);
				// get posted data
				
				// set product property values
				$contact->id=$data->id;
				$contact->email = $data->email;
				$contact->subject = $data->subject;
				$contact->message = $data->message;
				
				
				
				if($contact->update()){
					$result = array(
						"message" => "Contact was updated.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to update Contact.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter Contact name.",
					"status" => "error"
				);
			}
			return $result;
			
		}
		function deleteContact($data){
			$result;
			if(isset($data->id) && !empty($data->id)){
				require('core/database.php');
				require('models/Contact.php');

				$database = new Database();
				$db = $database->getConnection();
				
				
				
				$contact = new Contact($db);
				// get posted data
				
				// set product property values
				$contact->id=$data->id;
				
				
				
				
				if($contact->delete()){
					$result = array(
						"message" => "Contact was deleted.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to delete Contact.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter Contact id.",
					"status" => "error"
				);
			}
			return $result;
			
		}
		function updateContact2(){
			$result;
			if(isset($_POST['email']) && !empty($_POST['email'])){
				require('core/database.php');
				require('models/Contact.php');

				$database = new Database();
				$db = $database->getConnection();
				
				
				
				$contact = new Contact($db);
				// get posted data
				
				// set product property values
				$contact->id=$_POST['id'];
				$contact->email = $_POST['email'];
				$contact->subject = $_POST['subject'];
				$contact->message = $_POST['message'];
				
				
				
				if($contact->update()){
					$result = array(
						"message" => "Contact was updated.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to update Contact.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter Contact name.",
					"status" => "error"
				);
			}
			return $result;
			
		}
		function contactRegistration2(){
			$result;
			if(isset($_POST['email']) && !empty($_POST['email'])){
				require('core/database.php');
				require('models/Contact.php');

				$database = new Database();
				$db = $database->getConnection();
				
				
				
				$contact = new Contact($db);
				// get posted data
				
				// set product property values
				$contact->email = $_POST['email'];
				$contact->subject = $_POST['subject'];
				$contact->message = $_POST['message'];
				
				
				
				if($contact->create()){
					$result = array(
						"message" => "Contact was created.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to create Contact.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter Contact email.",
					"status" => "error"
				);
			}
			return $result;
			
		}
		
		function deleteContact2(){
			$result;
			if(isset($_POST['id']) && !empty($_POST['id'])){
				require('core/database.php');
				require('models/Contact.php');

				$database = new Database();
				$db = $database->getConnection();
				
				
				
				$contact = new Contact($db);
				// get posted data
				
				// set product property values
				$contact->id = $_POST['id'];
				
				
				
				
				if($contact->delete()){
					$result = array(
						"message" => "Contact was deleted.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to delete Contact.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter Contact id.",
					"status" => "error"
				);
			}
			return $result;
			
		}
		
		
		function readContacts(){
			require('core/database.php');
				require('models/Contact.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$contact = new Contact($db);
			 
			// query products
			$stmt = $contact->read();
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
					$food_item=array(
						"id" => $id,
						"email" => $email,
						"message" => html_entity_decode($message),
						"subject" => $subject
					);
					array_push($result["data"], $food_item);
				}
				$result["status"]='ok';
				$result["message"]='Contacts are loaded successfully';
				
			}else{
				$result["status"]='ok';
				$result["message"]='No Contacts to load';
			}
			return $result;
		}

		
	}
?>