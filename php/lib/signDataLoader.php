<?php
/*
 * Data Loader 
 * @Authors: Erica Tollefson, Rishita Hariyani, Marsha Battee
 */
require_once(dirname(__DIR__) . "/Classes/autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once("uuid.php");

use TheRouters\Capstone\Sign;

$secrets = new \Secrets("/etc/apache2/capstone-mysql/signson66.ini");
$pdo = $secrets->getPdoObject();
$signJson = @file_get_contents("signData.json");
if($signJson == false) {
	throw (new \RuntimeException("unable to read signData.json file", 500));
}
$signData = json_decode($signJson);

foreach($signData as $value) {
	$sign = new Sign (generateUuidV4(), $value->attributes->signDescription, $value->attributes->signLat, $value->attributes->signLong, $value->attributes->signName, $value->attributes->signType);
	$sign->insert($pdo);
}