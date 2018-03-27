<?php


require "tokendata.php";

	//matching hashes to give access to user
	function checkAccess($hash,$publichash,$content)
	{
		$con=json_encode($content);

		//getting the user privte key on the bases of public key 
		$privateHash=get_privatekey($publichash);
		$reqhash = hash_hmac('sha256', $con, $privateHash);
		
		if ($hash==$reqhash) 
		{
			return true;
		}
		else
			return false;

	}

