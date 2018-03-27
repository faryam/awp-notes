<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	require('service.php');
	
	
	
	$jk=new service();
	$jk->getConnection();
	if($jk->isValidConnection == false){
		die;
	}
	else if(isset($_POST['method']) && $_POST['method'] == 'productRegistration'){
		
		$results = $jk->productRegistration(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'readProducts'){
		$results = $jk->readProducts(); // calling member function 
		echo json_encode($results);
	}
?>