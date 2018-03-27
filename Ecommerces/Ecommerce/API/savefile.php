<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	
	class service
	{
		
		function signUP(){
			require('core/database.php');
			require('models/user.php');

			$database = new Database();
			$db = $database->getConnection();

			$user = new User($db);
			$sourcePath = $_FILES['userImage']['tmp_name'];       // Storing source path of the file in a variable
			$targetPath = "upload/".$_FILES['userImage']['name']; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ;
			
			$user->name = $_POST['name'];
			$user->email = $_POST['email'];
			$user->password = hash('sha512',$_POST['password']);
			$user->userImage = $targetPath;
			$user->created = date('Y-m-d H:i:s');
			$user->modified = date('Y-m-d H:i:s');
			
			if($user->name !="" && isset($user->name)){
				// create the user
				if($user->signUp()){
					echo '{';
						echo '"message": "User was created."';
					echo '}';
				}
				
				// if unable to create the user, tell the user
				else{
					echo '{';
						echo '"message": "Unable to create user."';
					echo '}';
				}
			}else{
				echo '{';
					echo '"message": "Please enter user name."';
				echo '}';
			}
		}
	}
	$jk=new service();
	if($_POST['method'] == 'signUP'){
		$results = $jk->signUP(); // calling member function 
	}
?>