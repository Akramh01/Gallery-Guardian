<?php

include 'bd.php';

$ch = curl_init("http://192.168.4.1:8080/json.htm?type=command&param=getdevices&rid=34");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
$json = json_decode($data, true);
$devices = $json['result'];
echo $devices[0];
// $device = $devices[0];
// echo "temperature actuelle : ".$device['Temp'];
curl_close($ch);

?>