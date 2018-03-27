<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	require('service.php');
	
	//$method=$_SERVER['REQUEST_METHOD'];
	$jk=new service();
	$data = json_decode(file_get_contents("php://input"));
	/*if($method=='POST')
	{	
		
		print_r($data);
		echo $data->method;
		echo json_encode($_POST);die();
	}*/
	if(isset($data->method) && $data->method == 'contactRegistration'){
		$results = $jk->contactRegistration($data); // calling member function 
		echo json_encode($results);
		
	}
	else if(isset($data->method) && $data->method == 'contactUpdate'){
		$results = $jk->updateContact($data); // calling member function 
		echo json_encode($results);
		
	}
	else if(isset($_POST['method']) && $_POST['method'] == 'contactUpdate'){
		$results = $jk->updateContact2(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($data->method) && $data->method == 'contactDelete'){
		$results = $jk->deleteContact($data); // calling member function 
		echo json_encode($results);
		
	}
	else if(isset($_POST['method']) && $_POST['method'] == 'contactDelete'){
		$results = $jk->deleteContact2(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_POST['method']) && $_POST['method'] == 'contactRegistration'){
		$results = $jk->contactRegistration2(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_POST['method']) && $_POST['method'] == 'foodItemRegistration'){
		$results = $jk->foodItemRegistration(); // calling member function 
		echo json_encode($results);
	}
	
	else if(isset($_POST['method']) && $_POST['method'] == 'updatefoodItem'){
		$results = $jk->updatefoodItem(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_POST['method']) && $_POST['method'] == 'deletefoodItem'){
		$results = $jk->deletefoodItem(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getFoodItems'){
		$results = $jk->readFoodItems(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getContacts'){
		$results = $jk->readContacts(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getFoodItem' &&isset($_GET['id'])){
		$results = $jk->readFoodItem(); // calling member function 
		echo json_encode($results);
	}
?>