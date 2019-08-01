


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
}




?>

