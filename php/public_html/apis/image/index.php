<?php
var_dump("got to line 2");

require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
use TheRouters\Capstone\{
	Sign, User, UserPhoto
};
/**
 * API for the cloudinary image
 *
 */
//verify the session start if not active
if(session_start() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
$reply->message = "image upload";
try {
	var_dump("got to line 24");
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/signson66.ini");
	var_dump($secrets);
	$pdo = $secrets->getPdoObject();
	$cloudinary = $secrets->getSecret("cloudinary");
	//determine which HTTP method is being used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];
	var_dump($cloudinary);
	$userPhotoUserId = filter_input(INPUT_GET, "userPhotoCloudinaryUserId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); //per Anna: $locationId ; variable_name: locationImageCloudinaryId
	$userPhotoId =  filter_input( INPUT_GET, "userPhotoId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		//per Anna: $profileId  variable_name: profileId
	$userPhotoSignId = filter_input(INPUT_GET, "userPhotoSignId", FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		//per Anna: $id ; variable_name: id
	\Cloudinary::config(["cloud_name" => $cloudinary->cloudName, "api_key" => $cloudinary->apiKey, "api_secret" =>$cloudinary->apiSecret]);
	//process GET requests
	if($method === "GET") {
		//set XSRF token
		setXsrfCookie();
		$reply->data = UserPhoto:: getAllUserPhotos($pdo)->toArray(); //per Anna: Location:: getAllLocations
	}
	else if($method === "PUT" || $method === "POST") {
		// enforce the user has a XSRF token
		verifyXsrf();
//		if(empty($_SESSION["user"]) === true) {
//			throw(new \InvalidArgumentException("you must be signed in to post photo", 403));
//		}
		// assigning variable to the user profile, add image extension
		$tempUserFileName = $_FILES["image"]["tmp_name"];
		// upload image to cloudinary and get public id
		$cloudinaryResult = \Cloudinary\Uploader::upload($tempUserFileName, array("width" => 200, "crop" => "scale"));
		// update reply
		$reply->message = $cloudinaryResult["secure_url"];
	}
} catch (Exception $exception ) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-Type: application/json");
// encode and return reply to front end caller
echo json_encode($reply);



