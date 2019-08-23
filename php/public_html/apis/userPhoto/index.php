<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
use \TheRouters\Capstone\userPhoto;

/**
 * Cloudinary API for UserPhoto
 *
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
	//check filter_input value is correct or not
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
		//gets  a specific photo associated based on its composite key
		if(empty($userPhotoId )=== false) {
			$reply->data = UserPhoto::getUserPhotoByUserPhotoId($pdo, $userPhotoId)->toArray();
		} //get all feature photo
		else if($userPhotoIsFeature === 1 ) {
			$reply->data = UserPhoto::getUserPhotoByUserPhotoIsFeature($pdo)->toArray();
		} //get all the photo associated with the SignId
		else if(empty($userPhotoSignId) === false) {
			$reply->data = UserPhoto::getUserPhotoByUserPhotoSignId($pdo, $userPhotoSignId)->toArray();
		} //get all the photo associated with the UserId
		else if(empty($userPhotoUserId) === false) {
			$reply->data = UserPhoto::getUserPhotoByUserPhotoUserId($pdo, $userPhotoUserId)->toArray();
		} else {
			$reply->data = UserPhoto::getAllUserPhotos($pdo)->toArray();
		}
	} elseif($method === "POST") {
		//enforce that the end user has a XSRF token.
		verifyXsrf();
		//use $_POST super global to grab the needed Id
		$userPhotoSignId = filter_input(INPUT_POST, "userPhotoSignId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		$userPhotoUserId = filter_input(INPUT_POST, "userPhotoUserId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		// assigning variable to the user profile, add image extension
		$tempUserFileName = $_FILES["userPhoto"]["tmp_name"];
		// upload image to cloudinary and get public id
		$cloudinaryResult = \Cloudinary\Uploader::upload($tempUserFileName, array("width" => 200, "crop" => "scale"));
		// after sending the image to Cloudinary, create a new image
		//todo: add $cloudinaryResult["signature"] here and in table/constructor for userPhoto in order to delete from Cloudinary
		$userPhoto = new UserPhoto(generateUuidV4(), $userPhotoSignId, $userPhotoUserId, $userPhotoCaption, $userPhotoIsFeature, $cloudinaryResult["secure_url"]);
		$userPhoto->insert($pdo);
		/*check if required here
		catch(Exception $exception) {
		  $reply->status = $exception->getCode();
		  $reply->message = $exception->getMessage();
	  }*/
//delete method
} else if($method === "DELETE") {
	//enforce that the end user has a XSRF token.
	verifyXsrf();
	// retrieve the Tweet to be deleted
		$userPhoto = UserPhoto::getUserPhotoByUserPhotoId($pdo,$userPhotoId);
	if($userPhoto === null)
	{
		throw(new RuntimeException("Photo does not exist", 404));
	}
	//enforce the user is log in and only trying to edit their own upload
	if(empty($_SESSION["user"]) === true || $_SESSION["user"]->getUserId()->toString() !== $userPhoto->getUserPhotoUserId()->toString())
	{
		throw(new \InvalidArgumentException("You are not allowed to delete this photo", 403));
	}
	//enforce the end user has a JWT token
	validateJwtHeader();
	// delete tweet
	$userPhoto->delete($pdo);
	// update reply
	$reply->message = "UserPhoto deleted OK";
}else {
		throw (new InvalidArgumentException("Invalid HTTP method request", 418));
	}
	// update the $reply->status $reply->message
} catch(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}

header("Content-Type: application/json");
echo json_encode($reply);

