<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	require('service.php');
	
	$jk=new service();

	$data = json_decode(file_get_contents("php://input"));
	//print_r($data);die();
	
	if(isset($data->method) && $data->method == 'login'){
		$results = $jk->verifyLogin($data); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'validateToken')
	{
		$header = array();
		$results = array();
		foreach (getallheaders() as $name => $value) {
			if($name == "Authorization"){
				$temp = array (
					$name=> $value
				);
				array_push($header,$temp);
			}
		}
		$pos = $header[0]["Authorization"];
		$results = $jk->validateLogin($pos); // calling member function 
		echo json_encode($results);
	}
	

	else if(isset($_GET['method']) && $_GET['method'] == 'getTimeTable' &&isset($_GET['day']))
	{
		$results = $jk->getAdminTimeTable(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getTimeTable')
	{
		$results = $jk->getTimeTable(); // calling member function 
		echo json_encode($results);
	}

	else if(isset($data->method) && $data->method == 'addSlot')
	{
		$results = $jk->addSlot($data); // calling member function 
		echo json_encode($results);
	}

	else if(isset($data->method) && $data->method == 'deleteClass')
	{
		$results = $jk->deleteClass($data); // calling member function 
		echo json_encode($results);
	}

	else if(isset($_GET['method']) && $_GET['method'] == 'getAddClasses' &&isset($_GET['slot_id']))
	{
		$results = $jk->getAddClasses(); // calling member function 
		echo json_encode($results);
	}

	else if(isset($data->method) && $data->method == 'addClass')
	{
		$results = $jk->addClass($data); // calling member function 
		echo json_encode($results);
	}



	
	
?>