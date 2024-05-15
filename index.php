<?php

include 

$ch=curl_init("http://192.168.4.1:8080/json.htm?type=command&param=switchlight&
 idx=1&switchcmd=On"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output=curl_exec($ch); 
$reponse=json_decode($output); 
if ($reponse->status == "OK") { 
echo "Prise activée"; 
} 
curl_close($ch); 