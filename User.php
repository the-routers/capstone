


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
	 * This is the ASSESSOR method for the userId
	 * @return @Uuid value of profile id (or null if new User)
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

}


?>

