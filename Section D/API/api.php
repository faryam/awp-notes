<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	require('service.php');
	
	$jk=new service();
	if(isset($_POST['method']) && $_POST['method'] == 'articleRegistration'){
		$results = $jk->articleRegistration(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_POST['method']) && $_POST['method'] == 'updateArticle'){
		$results = $jk->updatearticle(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_POST['method']) && $_POST['method'] == 'deleteArticle'){
		$results = $jk->deletearticle(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getArticleItems'){
		$results = $jk->readarticles(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getArticleItem' &&isset($_GET['id'])){
		$results = $jk->readarticle(); // calling member function 
		//echo json_encode($results);
	}
?>