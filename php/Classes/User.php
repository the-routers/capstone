<?php

namespace TheRouters\Capstone;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use ramsey\Uuid\Uuid;

class User implements \JsonSerializable {
	use ValidateUuid;


	/**This is the Id for the User. This is the PRIMARY KEY.
	 * @var = Uuid $userId
	 **/
	private $userId;

	/**This is the token sent by email to user to verify user is valid and not malicious.
	 * @var string $userActivationToken .
	 **/
	private $userActivationToken;


	/**This is the email address for the User.
	 * @var = string $userName
	 **/
	private $userEmail;


	/**This is the userName for the User.
	 * @var = string $userName
	 **/
	private $userName;


	/**This is the hash for the User's password.
	 * @var string $userHash
	 **/
	private $userHash;

	/**
	 * Constructor for this User
	 *
	 * @param string|Uuid $newUserId of this User or null if a new User
	 * @param string $newUserActivationToken activation token to safe guard against malicious accounts
	 * @param string $newUserEmail string containing user's email
	 * @param string $newUserName string containing new userName
	 * @param string $newUserHash string containing hash
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 *
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newUserId, ?string $newUserActivationToken, string $newUserEmail, string $newUserName, string $newUserHash) {
		try {
			$this->setUserId($newUserId);
			$this->setUserActivationToken($newUserActivationToken);
			$this->setUserEmail($newUserEmail);
			$this->setUserName($newUserName);
			$this->setUserHash($newUserHash);

		} catch(\InvalidArgumentException | \RangeException |\TypeError | \Exception $exception) {

			//Determines what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * This is the ASSESSOR method for the userId
	 * @return @Uuid value of id (or null if new User)
	 */
	public function getUserId(): Uuid {
		return $this->userId;
	}

	/**This is the MUTATOR method for the userId
	 * @param Uuid| string $newUserId value of new userId
	 * @throws \RangeException if $newUserId is not positive
	 * @throws \TypeError if the userId is not a string
	 **/
	public function setUserId($newUserId): void {
		try {
			$uuid = self::validateUuid($newUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store the userId
		$this->userId = $uuid;
	}


	/**
	 * This is the ASSESSOR method for the userName
	 * @return string value of userName
	 **/
	public function getUserName() : string {
		return $this->userName;
	}

	/**
	 * This is the MUTATOR method for the userName
	 * @param string $newUserName is the new value of the userName
	 * @throws \InvalidArgumentException if $newUserName is not a string or insecure
	 * @throws \RangeException if $newUserName is > 32 characters
	 * @throws \TypeError if $newUserName is not a string
	 **/
	public function setUserName(string $newUserName): void {
		//The following ensure that the UserName is properly formatted and secure
		$newUserName = trim($newUserName);
		$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserName) === true) {
			throw(new \InvalidArgumentException("username is empty or insecure"));
		}
		//Verifies the userName will fit in the database
		if(strlen($newUserName) > 50) {
			throw(new \RangeException("username length is too large; must be less than 50 characters"));
		}
		//Stores the username
		$this->userName = $newUserName;

	}


	/**
	 * This is the ASSESSOR method for the userHash
	 * @param string $userHash
	 * @return string for userHash
	 */
	public function getUserHash(): string {
		return $this->userHash;
	}

	/**This is the MUTATOR method for the userHash
	 * @param string $userHash is the new hash for the User
	 * @throws \InvalidArgumentException if $userHash is not a string or is insecure
	 * @throws \RangeException is $userHash is not 97 characters
	 * @throws \TypeError if $userHash is not a string
	 **/
	public function setUserHash(string $newUserHash): void {
		//This enforces that the hash is properly formatted and secure
		$newUserHash = trim($newUserHash);
		if(empty($newUserHash) === true) {
			throw(new \InvalidArgumentException("user password hash is empty or insecure"));
		}
		//This enforces that the hash is really an Argon hash
		$userHashInfo = password_get_info($newUserHash);
		if($userHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("user hash is not a valid hash"));
		}

		if(strlen($newUserHash) !== 97) {
			throw(new \RangeException("user hash must be 97 characters"));
		}
		//This stores the hash
		$this->userHash = $newUserHash; //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

	}


	/**
	 * This is the ASSESSOR method for the userEmail
	 *
	 * @return string value for userEmail
	 */
	public function getUserEmail(): string {
		return $this->userEmail;
	}

	/**
	 * This is the MUTATOR method for the userEmail
	 * @param string $newUserEmail is the new email for the User
	 * @throws \InvalidArgumentException if the new email is not a string or insecure
	 * @throws \RangeException if the $newUserEmail is greater than 128 characters
	 * @throws \TypeError if $newUserEmail is not a string
	 **/
	public function setUserEmail(string $newUserEmail): void {
		//This enforces that the user email is properly formatted and secure
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newUserEmail) == true) {
			throw(new \InvalidArgumentException("user email empty or insecure"));
		}
		//This verifies the userEmail will fit in the database
		if(strlen($newUserEmail) > 128) {
			throw(new \RangeException("user email is too large"));
		}
		//This stores the userEmail in the database
		$this->userEmail = $newUserEmail;
	}


	/**
	 * This is the ASSESSOR method for the userActivationToken;
	 * @return string value of the activation token
	 **/
	public function getUserActivationToken(): string {
		return $this->userActivationToken;
	}

	/**This is the MUTATOR METHOD for the userActivationToken
	 * @param string $newUserActivationToken
	 * @throws \InvalidArgumentException if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 **/
	public function setUserActivationToken(string $newUserActivationToken): void {
		if($newUserActivationToken === null) {
			$this->userActivationToken = null;
			return;
		}
		$newUserActivationToken = strtolower(trim($newUserActivationToken));
		if(ctype_xdigit($newUserActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//This enforces the user activation token is only 32 characters
		if(strlen($newUserActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32 characters"));
		}
		$this->userActivationToken = $newUserActivationToken;
	}


	/**
	 * Inserts this User info into MySQL
	 *
	 * @param \PDO $pdo is the PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {
		//This creates a query template
		$query = "INSERT INTO user(userId, userActivationToken, userEmail, userName, userHash) VALUES (:userId, :userActivationToken, :userEmail, :userName, :userHash)";
		$statement = $pdo->prepare($query);

		//This binds the member variables to the place holder in the template
		$parameters = ["userId" => $this->userId->getBytes(), "userActivationToken" => $this->userActivationToken, "userEmail" => $this->userEmail, "userName" => $this->userName, "userHash" => $this->userHash];
		$statement->execute($parameters);
	}

	/**
	 * Deletes this User from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {
		//Creates query template
		$query = "DELETE FROM user WHERE userId = :userId";
		$statement = $pdo->prepare($query);
		//This binds the member variables to the place holders in the template
		$parameters = ["userId" => $this->userId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * Updates this User from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 **/
	public function update(\PDO $pdo): void {
		//This creates query template
		$query = "UPDATE user SET userId = :userId, userActivationToken = :userActivationToken, userEmail = :userEmail, userName = :userName, userHash = :userHash WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		//This binds the member variables to the place holders in the template
		$parameters = ["userId" => $this->userId->getBytes(), "userActivationToken" => $this->userActivationToken, "userEmail" => $this->userEmail, "userName" => $this->userName, "userHash" => $this->userHash];
		$statement->execute($parameters);
	}


	/**
	 * Gets the User by userId
	 *
	 * @param \PDO $pdo $pdo PDO connection object
	 * @param  $userId is the userId to search for (the data type should be mixed/not specified)
	 * @return User|null User or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getUserByUserId(\PDO $pdo, $userId): ?User {
		//This sanitizes the userId before searching
		try {
			$userId = self::validateUuid($userId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		//This creates query template
		$query = "SELECT userId, userActivationToken, userEmail, userName, userHash FROM user WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		//This binds the userId to the place holder in the template
		$parameters = ["userId" => $userId->getBytes()];
		$statement->execute($parameters);

		//This grabs the User from mySQL
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$user = new User($row["userId"], $row["userActivationToken"], $row["userEmail"], $row["userName"], $row["userHash"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}

	/**
	 * gets the User by userName
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $userName userName to search for
	 * @return \SPLFixedArray of all Users found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserName(\PDO $pdo, string $userName): \SPLFixedArray {
		//This sanitizes the username before searching
		$userName = trim($userName);
		$userName = filter_var($userName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($userName) === true) {
			throw(new \PDOException("not a valid username"));
		}
		//This creates the query template
		$query = "SELECT  userId, userActivationToken, userEmail, userName, userHash FROM user WHERE userName = :userName";
		$statement = $pdo->prepare($query);

		//This binds the userName to the place holder in the template
		$parameters = ["userName" => $userName];
		$statement->execute($parameters);
		$users = new \SPLFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$user = new User($row["userId"], $row["userActivationToken"], $row["userEmail"], $row["userName"], $row["userHash"]);
				$users[$users->key()] = $user;
				$users->next();
			} catch(\Exception $exception) {

				//If the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($users);
	}

	/**
	 * Gets the user by userEmail
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $userEmail is the email to search for
	 * @return USer|null User or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserEmail(\PDO $pdo, string $userEmail): ?User {
		//This sanitize the email before searching
		$userEmail = trim($userEmail);
		$userEmail = filter_var($userEmail, FILTER_VALIDATE_EMAIL);
		if(empty($userEmail) === true) {
			throw(new \PDOException("not a valid email"));
		}
		//This creates a query template
		$query = "SELECT userId, userActivationToken, userEmail, userName, userHash FROM user WHERE userEmail = :userEmail";
		$statement = $pdo->prepare($query);

		//This binds the user email to the place holder in the template
		$parameters = ["userEmail" => $userEmail];
		$statement->execute($parameters);

		//This grabs the User from mySQL
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$user = new User($row["userId"], $row["userActivationToken"], $row["userEmail"], $row["userName"], $row["userHash"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}

	/**
	 * Gets the user by userActivationToken
	 *
	 * @param string $userActivationToken
	 * @param \PDO object $pdo
	 * @return User|null User or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserActivationToken(\PDO $pdo, string $userActivationToken): ?User {
		//Enforces activation token is in the right format and that it is a string representation of a hexadecimal
		$userActivationToken = trim($userActivationToken);
		if(ctype_xdigit($userActivationToken) === false) {
			throw(new \InvalidArgumentException("user activation token is empty or in the wrong format"));
		}

		//Creates the query template
		$query = "SELECT  userId, userActivationToken, userEmail, userName, userHash FROM user WHERE userActivationToken = :userActivationToken";
		$statement = $pdo->prepare($query);
		//Binds the user activation token to the placeholder in the template
		$parameters = ["userActivationToken" => $userActivationToken];
		$statement->execute($parameters);

		//Grabs the User from mySQL
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$user = new User($row["userId"], $row["userActivationToken"], $row["userEmail"], $row["userName"], $row["userHash"]);
			}
		} catch(\Exception $exception) {

			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}

	/**
	 * gets all Users
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Users found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllUsers(\PDO $pdo): \SPLFixedArray {
		//Creates query template
		$query = "SELECT userId, userActivationToken, userEmail, userName, userHash FROM user";

		$statement = $pdo->prepare($query);
		$statement->execute();
		//Builds an array of users
		$users = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$user = new User($row["userId"], $row["userActivationToken"], $row["userEmail"], $row["userName"], $row["userHash"]);
				$users[$users->key()] = $user;
				$users->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($users);
	}
/**
	/**
	 * gets all userEmails ::::::::::::::::::::::::::::::::::::::::::::::::::::Is this needed or will this return in getAllUsers????
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of userEmails found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type

	public static function getAllUserEmalis(\PDO $pdo): \SPLFixedArray {
		//Creates query template
		$query = "SELECT userId, userName FROM userEmail";

		$statement = $pdo->prepare($query);
		$statement->execute();
		//Builds an array of userEmails
		$userEmails = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$userEmail = new UserEmail($row["userId"], $row["userName"]);
				$userEmails[$userEmails->key()] = $userEmail;
				$userEmails->next();
			} catch(\Exception $exception) {
				//If the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($userEmails);
	}
**/

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["userId"] = $this->userId->toString();
		$fields["userName"] = $this->userName->toString();
		$fields["userEmail"] = $this->userEmail->toString();
		unset($fields["userHash"]);
		unset($fields["userActivationToken"]);
		return ($fields);
	}


}


?>

