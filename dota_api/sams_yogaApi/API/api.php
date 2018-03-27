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
	if(isset($_GET['method']) && $_GET['method'] == 'getHeros'){
		$results = $jk->readHeros(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getHero' &&isset($_GET['id'])){
		$results = $jk->readHero(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getBestPicks' &&isset($_GET['ids'])){
		
		$results = $jk->bestPicks(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getPlayer' &&isset($_GET['id'])){
		
		$results = $jk->playerData(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getPlayerMatches' &&isset($_GET['id'])){
		
		$results = $jk->playerMatchesData(); // calling member function 
		echo json_encode($results);
	}
	else if(isset($_GET['method']) && $_GET['method'] == 'getMatchDetails' &&isset($_GET['id'])){
		
		$results = $jk->matchData(); // calling member function 
		echo json_encode($results);
	}
?>