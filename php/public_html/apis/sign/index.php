<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
use TheRouters\Capstone\{
	Sign, User, UserPhoto
};
/**
 * API for Sign
 *
 * Based on API for Tweet by
 * @author Gkephart
 * @version 1.0
 */
//verify the session, if it is not active start it
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
	//grab the mySQL connection
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/signson66.ini");
	$pdo = $secrets->getPdoObject();
	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];
	// sanitize input
	$signId = filter_input(INPUT_GET, "signId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$signName = filter_input(INPUT_GET, "signName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$signType = filter_input(INPUT_GET, "signType", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	// make sure the sign id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($signId) === true)) {
		throw(new InvalidArgumentException("sign id cannot be empty or negative", 405));
	}
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
		//gets a sign by name
		if(empty($signId) === false) {
			$reply->data = Sign::getSignBySignId($pdo, $signId);
		} else if(empty($signName) === false) {
			$reply->data = Sign::getSignBySignName($pdo, $signName);
		} else if(empty($profileEmail) === false) {
			$reply->data = Sign::getSignBySignType($pdo, $signType);
		} else {
			$reply->data = Sign::getAllSigns($pdo)->toArray();
		}
	} elseif($method === "PUT") {
		//enforce that the XSRF token is present in the header
		verifyXsrf();
		//enforce the end user has a JWT token
		//validateJwtHeader();
		validateJwtHeader();
		//decode the response from the front end
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);
		//retrieve the sign to be updated
		$sign = Sign::getSignBySignId($pdo, $signId);
		if($sign === null) {
			throw(new RuntimeException("Sign does not exist", 404));
		}
		//sign description
		if(empty($requestObject->signDescription) === true) {
			throw(new \InvalidArgumentException ("No sign description present", 405));
		}
		//sign lat
		if(empty($requestObject->signLat) === true) {
			throw(new \InvalidArgumentException ("No sign latitude present", 405));
		}
		//sign long
		if(empty($requestObject->signLong) === true) {
			throw(new \InvalidArgumentException ("No sign longitude present", 405));
		}
		//sign name
		if(empty($requestObject->signName) === true) {
			throw(new \InvalidArgumentException ("Not a valid sign name", 405));
		}
		//sign type
		if(empty($requestObject->signType) === true) {
			throw(new \InvalidArgumentException ("No sign type present", 405));
		}
		$sign->setSignDescription($requestObject->signDescription);
		$sign->setSignLat($requestObject->signLat);
		$sign->setSignLong($requestObject->signLong);
		$sign->setSignName($requestObject->signName);
		$sign->setSignType($requestObject->signType);
		$sign->update($pdo);
		// update reply
		$reply->message = "Sign information updated";
	} else if($method === "POST") {
		// create new sign and insert into the database
		$sign = new Sign(generateUuidV4(), $_SESSION["sign"]->getSignId, $requestObject->signDescription, $requestObject->signLat, $requestObject->signLong, $requestObject->signName, $requestObject->signType );
		$sign->insert($pdo);
		// update reply
		$reply->message = "New sign created OK";
	} elseif($method === "DELETE") {
		//verify the XSRF Token
		verifyXsrf();
		//enforce the end user has a JWT token
		//validateJwtHeader();
		$sign = Sign::getSignBySignId($pdo, $signId);
		if($sign === null) {
			throw (new RuntimeException("Sign does not exist"));
		}
		validateJwtHeader();
		//delete the sign from the database
		$sign->delete($pdo);
		$reply->message = "Sign Deleted";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP request", 400));
	}
	// catch any exceptions that were thrown and update the status and message state variable fields
} catch
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