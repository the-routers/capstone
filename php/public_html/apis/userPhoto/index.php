<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
use \TheRouters\Capstone\UserPhoto;

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
	$userPhotoUrl = filter_input(INPUT_GET, "userPhotoUrl", FILTER_VALIDATE_URL);
	\Cloudinary::config(["cloud_name" => $cloudinary->cloudName, "api_key" => $cloudinary->apiKey, "api_secret" =>$cloudinary->apiSecret]);

	// process GET requests
	if($method === "GET") {
		// set XSRF token
		setXsrfCookie();
		//gets  a specific photo associated based on its composite key
		if(empty($userPhotoId) === false) {
			$reply->data = UserPhoto::getUserPhotoByUserPhotoId($pdo, $userPhotoId);
		} //get all feature photo
//		else if($userPhotoIsFeature === 1) {
//			$reply->data = UserPhoto::getUserPhotoByUserPhotoIsFeature($pdo);
	 //get all the photo associated with the SignId
	else if(empty($userPhotoSignId) === false) {
		$reply->data = UserPhoto::getUserPhotoByUserPhotoSignId($pdo, $userPhotoSignId);
	} //get all the photo associated with the UserId
	else if(empty($userPhotoUserId) === false) {
		$reply->data = UserPhoto::getUserPhotoByUserPhotoUserId($pdo, $userPhotoUserId);
	} else {
		$reply->data = UserPhoto::getAllUserPhotos($pdo)->toArray();
	}

//	} else if($method === "POST") {
//		//enforce that the end user has a XSRF token.
//		verifyXsrf();
//		//enforce the end user has a JWT token
//		validateJwtHeader();
//
//		// enforce the user is signed in
//		if(empty($_SESSION["user"]) === true) {
//			throw(new \InvalidArgumentException("you must be sign in to post photo", 403));
//		}
//		//decode the response from the front end
//		$requestContent = file_get_contents("php://input");
//		$requestObject = json_decode($requestContent);
//		if(empty($requestObject->userPhotoSignId) === true) {
//			throw (new \InvalidArgumentException("No Sign linked to the photo", 405));
//		}
////			if(empty($requestObject->userPhotoUserId) === true) {
////				throw (new \InvalidArgumentException("No user linked to the photo", 405));
////			}
//		if(empty($requestObject->userPhotoCaption) === true) {
//			$requestObject->userPhotoCaption = null;
//		}
//		if(empty($requestObject->userPhotoIsFeature) === true) {
//			throw (new \InvalidArgumentException("Mark photo as feature or not", 405));
//		}
//		if(empty($requestObject->userPhotoUrl) === true) {
//			throw (new \InvalidArgumentException("Photo url is required", 405));
//		}
//
	} else if($method === "POST" || $method === "PUT") {
			 if($method === "POST") {
				 //enforce that the end user has a XSRF token.
				 verifyXsrf();
//				 //enforce the end user has a JWT token
//				 validateJwtHeader();
				 // enforce the user is signed in
				 if(empty($_SESSION["user"]) === true) {
					 throw(new \InvalidArgumentException("you must be signed in to post photo", 403));
				 }

				 $userPhotoSignId = filter_input(INPUT_POST, "userPhotoSignId");
				 $userPhotoCaption = filter_input(INPUT_POST, "userPhotoCaption");
				 if(empty($userPhotoSignId) === true) {
					 throw (new \InvalidArgumentException("Selected sign is required", 405));
				 }
				 // assigning variable to the user profile, add image extension
				 $tempUserFileName = $_FILES["image"]["tmp_name"];
				 // upload image to cloudinary and get public id
				 $cloudinaryResult = \Cloudinary\Uploader::upload($tempUserFileName, array("width" => 200, "crop" => "scale"));

				 $userPhoto = new UserPhoto(generateUuidV4(), $userPhotoSignId, $_SESSION["user"]->getUserId(), $userPhotoCaption, 0, $cloudinaryResult["secure_url"]);
				 $userPhoto->insert($pdo);
				 $reply->message = "Photo is uploaded";
			 }
			}else if($method === "DELETE") {
				//enforce the end user has a XSRF token.
				verifyXsrf();
				//grab the photo by its composite key
				$userPhoto = UserPhoto::getUserPhotoByUserPhotoId($pdo, $userPhotoId);
				if($userPhoto === null) {
					throw (new RuntimeException("photo does not exist"));
				}
				//enforce the user is signed in and only trying to edit their own like
				if(empty($_SESSION["user"]) === true || $_SESSION["user"]->getUserId()->toString() !== $userPhoto->getUserPhotoUserId()->toString()) {
					throw(new \InvalidArgumentException("You are not allowed to delete this photo", 403));
				}
				validateJwtHeader();
				//preform the actual delete
				$userPhoto->delete($pdo);
				//update the message
				$reply->message = "Photo successfully deleted";
			}
			// if any other HTTP request is sent throw an exception
		 else {
			throw new \InvalidArgumentException("invalid http request", 400);
		}
		//catch any exceptions that is thrown and update the reply status and message
	}
catch
	(\Exception | \TypeError $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
// encode and return reply to front end caller
echo json_encode($reply);

////delete method
//} else if($method === "DELETE") {
//	//enforce that the end user has a XSRF token.
//	verifyXsrf();
//	// retrieve the Tweet to be deleted
//		$userPhoto = UserPhoto::getUserPhotoByUserPhotoId($pdo,$userPhotoId);
//	if($userPhoto === null)
//	{
//		throw(new RuntimeException("Photo does not exist", 404));
//	}
//	//enforce the user is log in and only trying to edit their own upload
//	if(empty($_SESSION["user"]) === true || $_SESSION["user"]->getUserId()->toString() !== $userPhoto->getUserPhotoUserId()->toString())
//	{
//		throw(new \InvalidArgumentException("You are not allowed to delete this photo", 403));
//	}
//	//enforce the end user has a JWT token
//	validateJwtHeader();
//	// delete tweet
//	$userPhoto->delete($pdo);
//	// update reply
//	$reply->message = "UserPhoto deleted OK";
//}else {
//		throw (new InvalidArgumentException("Invalid HTTP method request", 418));
//	}
//	// update the $reply->status $reply->message
//} catch(\Exception | \TypeError $exception) {
//	$reply->status = $exception->getCode();
//	$reply->message = $exception->getMessage();
//}
//
//header("Content-Type: application/json");
//echo json_encode($reply);
//
