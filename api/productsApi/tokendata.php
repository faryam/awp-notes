<?php

function get_privatekey($publicKey)
{
	$keys = [
		"3441df0babc2a2dda551d7cd39fb235bc4e09cd1e4556bf261bb49188f548348"=>"e249c439ed7697df2a4b045d97d4b9b7e1854c3ff8dd668c779013653913572e"
	];
	
	foreach($keys as $key=>$pvt)
	{
		if($key==$publicKey)
		{
			return $pvt;
			break;
		}
	}
}