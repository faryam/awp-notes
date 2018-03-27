<?php
	class service
	{
		// read product
		function readarticles(){
			require('core/database.php');
			require('models/Article.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$article = new Article($db);
			 
			// query products
			$stmt = $article->read();
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
					$articles=array(
						"id" => $articleId,
						"name" => $title,
						"description" => html_entity_decode($detail),
						"imageUrl" => $featureImage,
						"category_id" => $categoryId,
						"category_name" => $category_name,
						"createdDate"=>$createdDate
					);
					array_push($result["data"], $articles);
				}
				$result["status"]='ok';
				$result["message"]='Product are loaded successfully';
				
			}else{
				$result["status"]='ok';
				$result["message"]='Product are loaded successfully';
			}
			return $result;
		}
		function articleRegistration(){
			$result;
			if(isset($_POST['title']) && !empty($_POST['title'])){
				require('core/database.php');
				require('models/Article.php');

				$database = new Database();
				$db = $database->getConnection();
				
				$sourcePath = $_FILES['article_image']['tmp_name'];       // Storing source path of the file in a variable
				//upload folder should exists
				
				$targetPath = "assets/img/articles/".$_FILES['article_image']['name']; // Target path where file is to be stored
				move_uploaded_file($sourcePath,"../".$targetPath) ;
				
				$article = new Article($db);
				// get posted data
				
				// set product property values
				$article->name = $_POST['title'];
				
				$article->description = $_POST['details'];
				$article->category_id = $_POST['article_category'];
				$article->imageUrl = $targetPath;
				$article->created = date('Y-m-d H:i:s');
				
				
				if($article->create()){
					$result = array(
						"message" => "article was created.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to create article.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter article name.",
					"status" => "error"
				);
			}
			return $result;
			
		}
		function readarticle()
		{
			require('core/database.php');
			require('models/Article.php');
			// instantiate database and product object
			$database = new Database();
			$db = $database->getConnection();
			 
			// initialize object
			$article = new Article($db);
			$article ->id=$_GET['id'];
			// query products
			$article->readOne();

			$article=array(
						"id" => $article->id,
						"name" => $article->name,
						"description" => $article->description,
						"imageUrl" =>$article->imageUrl,
						"category_id" =>$article->category_id,
						"category_name" => $article->category_name,
						"createdDate"=>$article->created
					);
			print_r(json_encode($article));

		}


		function updatearticle(){
			$result;
			if(isset($_POST['id']) && !empty($_POST['id'])){
				require('core/database.php');
				require('models/Article.php');

				$database = new Database();
				$db = $database->getConnection();
			
				if(isset($_FILES['article_image']['name'])&& !empty($_FILES['article_image']['name']))
				{
					$sourcePath = $_FILES['article_image']['tmp_name'];       // Storing source path of the file in a variable
					//upload folder should exists
					
					$targetPath = "assets/img/articles/".$_FILES['article_image']['name']; // Target path where file is to be stored
					move_uploaded_file($sourcePath,"../".$targetPath) ;
				}
				else
					$targetPath=$_POST['image'];
				$article = new Article($db);
				// get posted data
				
				// set product property values
				$article->id = $_POST['id'];
				$article->name = $_POST['title'];
				
				$article->description = $_POST['details'];
				$article->category_id = $_POST['article_category'];
				$article->imageUrl = $targetPath;
				
				
				
				if($article->update()){
					$result = array(
						"message" => "article was updated.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to update article.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter article ID.",
					"status" => "error"
				);
			}
			return $result;
			
		}

		function deletearticle(){
			$result;
			if(isset($_POST['id']) && !empty($_POST['id'])){
				require('core/database.php');
				require('models/Article.php');

				$database = new Database();
				$db = $database->getConnection();
				
				
				
				$article = new Article($db);
				// get posted data
				
				// set product property values
				$article->id = $_POST['id'];
				
				
				
				
				if($article->delete()){
					$result = array(
						"message" => "article was deleted.",
						"status" => "ok"
					);
				}else{
					$result = array(
						"message" => "Unable to delete article.",
						"status" => "error"
					);
				}
			}else{
				$result = array(
					"message" => "Please enter article id.",
					"status" => "error"
				);
			}
			return $result;
			
		}

		
	}
?>