<?php

	include "database.php";
	include "products.php";
	require "auth.php";


	//reading headers from request
	$hash="";
	$publichash="";

	foreach (getallheaders() as $name => $value)
	 {
    	if ($name=="X-Hash")
    	{
    		$hash=$value;
    	}
    	elseif ($name=="X-Public")
    	{
    		$publichash=$value;
    	}
    }

    // checking for access
    if (checkAccess($hash,$publichash,$_POST))
    {
    	
		$database = new DataBaseConnection();
		$db = $database->getConnection();

		$product = new Product($db);
		
		$method=$_SERVER['REQUEST_METHOD'];
		if($method=='GET')
		{
			if(isset($_GET['id']))
				$product->readProduct($_GET['id']);
			else
				$product->readAllProducts();
		}
		elseif ($method=='POST')
		 {
			if(isset($_POST['id']))
				$product->readProduct($_POST['id']);
			else
				$product->readAllProducts();
		}
		
	}
	else
		echo "Access not allowed";

