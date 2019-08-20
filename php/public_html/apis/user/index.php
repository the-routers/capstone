<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");

use TheRouters\Capstone\ {
	User
};
/**
 * API for User
 *
 * @author mbattee (marsha@sanesuite.com)
 */

//verify the session. if it is not active session, start it.
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
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userName = filter_input(INPUT_GET, "userName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userEmail = filter_input(INPUT_GET, "userEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
		//gets photo by content
		if(empty($id) === false) {
			$reply->data = User::getUserByUserId($pdo, $id);
		} else if(empty($userName) === false) {
			$reply->data = User::getUserByUserName($pdo, $userName);
		} else if(empty($userEmail) === false) {
			$reply->data = User::getUserByUserEmail($pdo, $userEmail);
		}

	} elseif($method === "PUT") {
		//enforce that the XSRF token is present in the header
		verifyXsrf();
		//enforce the end user has a JWT token
		//validateJwtHeader();
		//enforce the user is signed in and only trying to edit their own "user" profile
		if(empty($_SESSION["user"]) === true || $_SESSION["user"]->getUserId()->toString() !== $id) {
			throw(new \InvalidArgumentException("You are not allowed to access this user", 403));
		}
		validateJwtHeader();
		//decode the response from the front end
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);
		//retrieve the user to be updated
		$user = User::getUserByUserId($pdo, $id);
		if($user === null) {
			throw(new RuntimeException("User does not exist", 404));
		}






