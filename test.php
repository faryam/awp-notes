<?php
//echo 'Current PHP version: ' . phpversion();
//$ch = curl_init('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=8AD8BD35817491CC299FF2A95E7F74FC&steamids=76561197960435530');

$a = '1';
$b = &$a;
echo $b.",";
$b = "2$b";
echo $a.", ".$b;die();

$ch = curl_init('https://api.opendota.com/api/heroStats');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

$result = curl_exec($ch);
curl_close($ch);
$data = json_decode($result);
print_r($data);die();
//printing response
$conn = new mysqli("localhost","root","","dota2");
for($x = 0; $x < count($data); $x++) {
	//$qor="INSERT INTO hero(id, name, img, local_name) VALUES ('".$data[$x]->id."','".$data[$x]->name."','https://api.opendota.com".$data[$x]->img."','".$data[$x]->localized_name."')";
		//$conn->query($qor);
    echo $data[$x]->id." ".$data[$x]->name." ".$data[$x]->localized_name." ".$data[$x]->img;
    echo "<br>";
}
?>