<?php
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
 * Cloudinary API for Images
 *
 * based on:
 * @author Marty Bonacci
 * @version 1.0
 */
// start session
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
// prepare an empty reply
$reply = new StdClass();
$reply->status = 200;
$reply->data = null;
try {
	// Grab the MySQL connection
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/signson66.ini");
	$pdo = $secrets->getPdoObject();
	$cloudinary = $secrets->getSecret("cloudinary");
	//determine which HTTP method is being used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];
	$userPhotoId = filter_input(INPUT_GET, "userPhotoId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userPhotoSignId = filter_input(INPUT_GET, "userPhotoSignId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userPhotoUserId = filter_input(INPUT_GET, "userPhotoUserId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userPhotoCaption = filter_input(INPUT_GET, "userPhotoCaption", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userPhotoIsFeature = filter_input(INPUT_GET, "userPhotoIsFeature", FILTER_VALIDATE_INT);
	\Cloudinary::config(["cloud_name" => $cloudinary->cloudName, "api_key" => $cloudinary->apiKey, "api_secret" => $cloudinary->apiSecret]);
	// process GET requests
	if($method === "GET") {
		// set XSRF token
		setXsrfCookie();
		$reply->data = UserPhoto::getAllUserPhotos($pdo)->toArray();
	}  elseif($method === "POST") {
		//enforce that the end user has a XSRF token.
		verifyXsrf();
		//use $_POST super global to grab the needed Id
		$userPhotoSignId = filter_input(INPUT_POST, "userPhotoSignId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		// assigning variable to the user profile, add image extension
		$tempUserFileName = $_FILES["image"]["tmp_name"];
		// upload image to cloudinary and get public id
		$cloudinaryResult = \Cloudinary\Uploader::upload($tempUserFileName, array("width" => 200, "crop" => "scale"));
		// after sending the image to Cloudinary, create a new image
		//todo: add $cloudinaryResult["signature"] here and in table/constructor for userPhoto in order to delete from Cloudinary
		$userPhoto = new UserPhoto(generateUuidV4(), $userPhotoSignId, $userPhotoUserId, $userPhotoCaption, $userPhotoIsFeature, $cloudinaryResult["secure_url"]);
		$userPhoto->insert($pdo);
		// update reply
		$reply->message = "Image uploaded Ok";
	}
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-Type: application/json");
// encode and return reply to front end caller
echo json_encode($reply);