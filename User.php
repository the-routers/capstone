


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


	/**
	 * This is the ASSESSOR method for the userPassword
	 *	@param string $userPassword
	 * @return string for user password
	 */
	public function getUserPassword(): string {
		return $this->userPassword;
	}


	/**
	 * This is the ASSESSOR method for the userEmail
	 * @return string value for user email
	 */
	public function getUserEmail() : string {
		return $this->userEmail;
	}


	/**
	 * This is the ASSESSOR method for the userActivationToken;
	 * @return string value of the activation token
	 */
	public function getUserActivationToken() : string {
		return $this->userActivationToken;
	}

}


?>

