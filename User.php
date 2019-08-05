


<?php

class User {

	/**This is the ID for the user. This is the PRIMARY KEY.
	 * @var = Uuid $userId
	 **/
	private $userId;


	/**This is the username for the user.
	 * @var = string $userName
	 **/
	private $userName;


	/**This is the email address for the user.
	 *@var = string $userName
	 **/
	private $userEmail;


	/**This is the password for the user's email address.
	 * @var string $userPassword
	 **/
	private $userPassword;


	/**This is the token sent by email to user to verify user is valid and not malicious.
	 * @var string $userActivationToken.
	 **/
	private $userActivationToken;




	/**
	 * Constructor for this User
	 *
	 * @param string|Uuid $newUserId of this User or null if a new User
	 * @param string $newUserName string containing new user name
	 * @param string $newUserEmail string containing email
	 * @param string $newUserPassword string containing password
	 * @param string $newUserActivationToken activation token to safe guard against malicious accounts

	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 *
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newUserId, ?string $newUserName, string $newUserEmail, ?string $newUserPassword, ?string $newUserActivationToken) { //Added ? to string at newUserPassword
		try {
			$this->setUserId($newUserId);
			$this->setUserName($newUserName);
			$this->setUserEmail($newUserEmail);
			$this->setUserPassword($newUserPassword);
			$this->setUserActivationToken($newUserActivationToken);
		} catch(\InvalidArgumentException | \RangeException |\TypeError | \Exception $exception) {

			//Determines what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}





	/**
	 * This is the ASSESSOR method for the userId
	 * @return @Uuid value of  id (or null if new User)
	 */
	public function getUserId() : Uuid {
		return $this->userId;
	}

	/**This is the MUTATOR method for the userId
	 * @param Uuid| string $newUserId value of new user id
	 * @throws \RangeException if $newUserId is not positive
	 * @throws \TypeError if the user Id is not a string
	 **/
	public function setUserId($newUserId) : void {
		try {
				$uuid = self::validateUuid($newUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store the user id
		$this->userId = $uuid;
	}







	/**
	 * This is the ASSESSOR method for the username
	 * @return string value of user name
	 **/
	public function getUserName() {
		return $this->userName;
	}

	/**
	 * This is the MUTATOR method for the username
	 * @param string $newUserName is the new value of the username
	 * @throws \InvalidArgumentException if $newUserName is not a string or insecure
	 * @throws \RangeException if $newUserName is > 32 characters
	 * @throws \TypeError if $newUserName is not a string
	 **/
	public function setUserName($newUserName) : void {
		//The following ensure that the UserName is properly formatted and secure
		$newUserName = trim($newUserName);
		$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserName) === true) {
			throw(new \InvalidArgumentException("username is empty or insecure"));
		}
		//the following verifies the userName will fit in the database
		if(strlen($newUserName) > 50) {
			throw(new \RangeException("username length is too large; must be less that 50 characters"));
		}
		//the following stores the username
		$this->UserName = $newUserName;

	}






	/**
	 * This is the ASSESSOR method for the userPassword
	 *	@param string $userPassword
	 * @return string for user password
	 */
	public function getUserPassword(): string {
		return $this->userPassword;
	}

	/**This is the MUTATOR method for the userPassword
	 * @param string $userPassword is the new password for the user
	 * @throws \InvalidArgumentException if $userPassword is not a string or is insecure
	 * @throws \RangeException is $userPassword is more than 50 characters
	 * @throws \TypeError if $userPassword is not a string
	 **/
	public function setUserPassword(string $newUserPassword) : void {
		//This enforces that the password is properly formatted and secure
		$newUserPassword = trim($newUserPassword);
		if(empty($newUserPassword) === true) {
			throw(new \InvalidArgumentException("user password is empty or insecure"));
		}
		//This enforces that the password is really an Argon password
		$userPasswordInfo = password_get_info($newUserPassword);
		if($newUserPassword["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("user password is not a valid password"));
		}
		//This enforces that the hash is exactly 97 characters. :::::____CHECK THIS VALUE_____:::::::::::::::::::::::::::::::::::::::::
		if(strlen($newUserPassword) !== 97) {
			throw(new \RangeException("user password must be 97 characters"));
		}
		//This stores the password
		$this->userPassword = $newUserPassword; //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

	}





	/**
	 * This is the ASSESSOR method for the userEmail
	 * @return string value for user email
	 */
	public function getUserEmail() : string {
		return $this->userEmail;
	}

	/**
	 * This is the MUTATOR method for the userEmail
	 * @param string $newUserEmail is the new email for the user
	 * @throws \InvalidArgumentException if the new email is not a string or insecure
	 * @throws \RangeException if the $newUserEmail is greater than 128 characters
	 * @throws \TypeError if $newUserEmail is not a string
	 **/
	public function setUserEmail(string $newUserEmail) : void {
		//This enforces that the user email is properly formatted and secure
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newUserEmaild) == true) {
			throw(new \InvalidArgumentException("user email empty or insecure"));
		}

		//This verifies the user email will fit in the database
		if(strlen($newUserEmail) > 128) {
			throw(new \RangeException("user email is too large"));
		}
		//This stores the user email in the database
		$this->userEmail = $newUserEmail;

	}





	/**
	 * This is the ASSESSOR method for the userActivationToken;
	 * @return string value of the activation token
	 **/
	public function getUserActivationToken() : string {
		return $this->userActivationToken;
	}



	/**This is the MUTATOR METHOD for the user activation token
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
	 * Inserts this user info into MySQL
	 *
	 * @param \PDO $pdo is the PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert (\PDO $pdo) : void {

		//This creates a query template.
		$query = "INSERT INTO User(userId, userName, userEmail, userPassword, userActivationToken) VALUES (:userId, :userName, :userEmail, :userPassword, :userActivationToken)";
		$statement = $pdo->prepare($query);

		//This binds the member variables to the place holder in the template
		$parameters = ["userId" => $this->userId->getBytes(), "userName" => $this->userName, "userEmail" => $this->userEmail,"userPassword" => $this->userPassword, "userActivationToken" => $this->userActivationToken];
		$statement->execute($parameters);
	}





	/**
	 * Deletes this user from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {
		//createa query template
		$query = "DELETE FROM User WHERE userId = :userId";
		$statement = $pdo->prepare($query);
		//This binds the member variables to the place holders in the template
		$parameters = ["userId" => $this->userId->getBytes()];
		$statement->execute($parameters);
	}




	/**
	 * updates this user from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 **/
	public function update(\PDO $pdo): void {
		//This creates query template
		$query = "UPDATE User SET userId = :userId, userName = :userName, userEmail = :userEmail, userPassword = :userPassword, userActivationToken = userActivationToken WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		//This binds the member variables to the place holders in the template
		$parameters = ["userId" => $this->userId->getBytes(), "userName" => $this->userName, "userEmail" => $this->userEmail, "userPassword" => $this->userPassword, "userActivationToker" => $this->userActivationToken];
		$statement->execute($parameters);
	}





	/**
	 * gets the user by userId
	 *
	 * @param \PDO $pdo $pdo PDO connection object
	 * @param  $userId user id to search for (the data type should be mixed/not specified)
	 * @return User|null User or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getUserByUserId(\PDO $pdo, $userId): ?User {
		//This sanitizes the user id before searching
		try {
			$userId = self::validateUuid($userId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		//This creates query template
		$query = "SELECT userId, userName, userEmail, userPassword, userActivationToken FROM User WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		//This binds the user id to the place holder in the template
		$parameters = ["userId" => $userId->getBytes()];
		$statement->execute($parameters);

		//This grabs the User from mySQL
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$user = new User($row["userId"], $row["userName"], $row["userEmail"], $row["userPassword"],$row["userActivationToken"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($User);
	}




	/**
	 * gets the user by userName
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $userName username to search for
	 * @return \SPLFixedArray of all profiles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserName(\PDO $pdo, string $userName) : \SPLFixedArray {
		//This sanitizes the at handle before searching
		$userName = trim($userName);
		$userName = filter_var($userName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($userName) === true) {
			throw(new \PDOException("not a valid username"));
		}
		//This creates the query template
		$query = "SELECT  userId, userName, userEmail, userPassword, userActivationToken FROM User WHERE userName = :userName";
		$statement = $pdo->prepare($query);

		//This binds the username to the place holder in the template
		$parameters = ["userName" => $userName];
		$statement->execute($parameters);
		$users = new \SPLFixedArray($statement->rowCount());  //:::::::::::::::::::::::::::::::::::::IS "USERS" CORRECT:::::::::::::::::::::::
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				$user = new User($row["userId"], $row["userName"], $row["userEmail"], $row["userPassword"], $row["userActivationToken"]);
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
	 * gets the user by userEmail
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $userEmail email to search for
	 * @return USer|null USer or null if not found
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
		$query = "SELECT userId, userName, userEmail, userPassword, userActivationToken FROM User WHERE userEmail = :userEmail";
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
				$user = new User($row["userId"], $row["userName"], $row["userEmail"], $row["userPassword"], $row["userActivationToken"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}




	/**
	 * Gets the profile by user activation token
	 *
	 * @param string $userActivationToken
	 * @param \PDO object $pdo
	 * @return User|null User or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserActivationToken(\PDO $pdo, string $userActivationToken) : ?User {
		//Enforces activation token is in the right format and that it is a string representation of a hexadecimal
		$userActivationToken = trim($userActivationToken);
		if(ctype_xdigit($userActivationToken) === false) {
			throw(new \InvalidArgumentException("user activation token is empty or in the wrong format"));
		}

		//Creates the query template
		$query = "SELECT  userId, userName, userEmail, userPassword, userActivationToken FROM user WHERE userActivationToken = :userActivationToken";
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
				$user = new User($row["userId"], $row["userName"], $row["userEmail"], $row["userPassword"], $row["userActivationToken"]);
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
	public static function getAllUsers(\PDO $pdo) : \SPLFixedArray {
		//Creates query template
		$query = "SELECT userId, userName, userEmail FROM user";

		$statement = $pdo->prepare($query);
		$statement->execute();
		//Builds an array of users
		$users = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$user = new User($row["userId"], $row["userName"], $row["userEmail"]);
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
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["userId"] = $this->userId->toString();           //in the tweet profile example
		$fields["userName"] = $this->userName->toString();
		$fields["userEmail"] = $this->userEmail->toString();
		unset($fields["userPassword"]);
		unset($fields["userActivationToken"]);
		return ($fields);
	}


}


?>

