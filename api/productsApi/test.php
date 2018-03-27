<?php


//keys are generated using this method;
//$hash = hash('sha256', mt_rand());


//User public key
$publicHash = '3441df0babc2a2dda551d7cd39fb235bc4e09cd1e4556bf261bb49188f548348';

//User private key
$privateHash = 'e249c439ed7697df2a4b045d97d4b9b7e1854c3ff8dd668c779013653913572e';

//data too be posted
$content    = array(
    'id' => '4'
);
//generating hash t be sent with request
$con=json_encode($content);
$hash = hash_hmac('sha256', $con, $privateHash);

//add public key and hash to request header
$headers = array(
    'X-Public: '.$publicHash,
    'X-Hash: '.$hash
);

//sending request
$ch = curl_init('http://localhost/api/productsApi/read.php');
curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$content);

$result = curl_exec($ch);
curl_close($ch);

//printing response
echo "RESULT<br>======<br>".print_r($result, true)."<br><br>";

?>