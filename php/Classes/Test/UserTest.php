<?php

namespace TheRouters\Capstone\Test;

use TheRouters\Capstone\{
	User, Sign, UserPhoto
};

//Grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PHPUnit test for the User class
 *
 * This is a complete PHPUnit test of the User class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see User
 * @author Marsha Battee <marsha@sanesuite.com>
 **/
class UserTest extends SignsOn66Test {
	/**
	 * Placeholder until account activation is created
	 * @var string $VALID_ACTIVATION
	 */


	protected $VALID_ACTIVATION;   //Should this be activation token? // Where is the state variable for the UserId?
	/**
	 * Valid username to use
	 * @var string $VALID_USERNAME
	 **/

	protected $VALID_USERNAME = "johntherouter";
	/**
	 * Second valid username to use to test for updates
	 * @var string $VALID_USERNAME2
	 **/

	protected $VALID_USERNAME2 = "janetherounter";
	/**
	 * Valid email to use
	 * @var string $VALID_USEREMAIL
	 **/

	protected $VALID_USEREMAIL = "router@test.com";

	/**
	 * Valid password to use
	 * @var $VALID_PASSWORD
	 */
	protected $VALID_PASSWORD;


	/**
	 * Run the default setup operation to create salt and hash.
	 */
	public final function setUp(): void {
		parent::setUp();
		//
		$password = "abc123";
		$this->VALID_PASSWORD = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));
	}

	/**
	 * Test inserting a valid User and verify that the actual mySQL data matches
	 **/
	public function testInsertValidUser(): void {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USEREMAIL, $this->VALID_USERNAME, $this->VALID_PASSWORD);
		$user->insert($this->getPDO());
		// Grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USERNAME);
		$this->assertEquals($pdoUser->getUserPassword(), $this->VALID_PASSWORD);
	}

	/**
	 * Test inserting a User, editing it, and then updating it
	 **/
	public function testUpdateValidUser() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// Create a new User and insert to into mySQL
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USEREMAIL, $this->VALID_USERNAME, $this->VALID_PASSWORD);
		$user->insert($this->getPDO());
		// Edit the User and update it in mySQL
		$user->setUserName($this->VALID_USERNAME);
		$user->update($this->getPDO());
		// Grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USERNAME2);
		$this->assertEquals($pdoUser->getUserPassword(), $this->VALID_PASSWORD);
	}

	/**
	 * Test creating a User and then deleting it
	 **/
	public function testDeleteValidUser(): void {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USEREMAIL, $this->VALID_USERNAME, $this->VALID_PASSWORD);
		$user->insert($this->getPDO());
		// Delete the User from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$user->delete($this->getPDO());
		// Grab the data from mySQL and enforce the User does not exist
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertNull($pdoUser);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("user"));
	}

	/**
	 * Test inserting a User and regrabbing it from mySQL
	 **/
	public function testGetValidUserByUserId(): void {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USEREMAIL, $this->VALID_USERNAME, $this->VALID_PASSWORD);
		$user->insert($this->getPDO());
		// Grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USERNAME);
		$this->assertEquals($pdoUser->getUserPassword(), $this->VALID_PASSWORD);
	}

//	/**
//	 * Test grabbing a User that does not exist
//	 **/
//	public function testGetInvalidUserByUserId(): void {
//		// Grab a user id that exceeds the maximum allowable user id
//		$fakeUserId = generateUuidV4();
//		$user = User::getUserByUserId($this->getPDO(), $fakeUserId);
//		$this->assertNull($user);
//	}

	public function testGetValidUserByUserName() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USEREMAIL, $this->VALID_USERNAME, $this->VALID_PASSWORD);
		$user->insert($this->getPDO());
		//Grab the data from MySQL
		$results = User::getUserByUserName($this->getPDO(), $this->VALID_USERNAME);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		//Enforce no other objects are bleeding into user
		$this->assertContainsOnlyInstancesOf("TheRouters\\Capstone\\User", $results);
		//Enforce the results meet expectations
		$pdoUser = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USERNAME);
		$this->assertEquals($pdoUser->getUserPassword(), $this->VALID_PASSWORD);
	}

	/**
	 * Test grabbing a User by username that does not exist
	 **/
	public function testGetInvalidUserByUserName(): void {
		// Grab an username that does not exist
		$user = User::getUserByUserName($this->getPDO(), "doesnotexist");
		$this->assertCount(0, $user);
	}

	/**
	 * Test grabbing a User by email
	 **/
	public function testGetValidUserByEmail(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USEREMAIL, $this->VALID_USERNAME, $this->VALID_PASSWORD);
		$user->insert($this->getPDO());
		// Grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserEmail($this->getPDO(), $user->getUserEmail());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USERNAME);
		$this->assertEquals($pdoUser->getUserPassword(), $this->VALID_PASSWORD);
	}

	/**
	 * Test grabbing a User by an email that does not exists
	 **/
	public function testGetInvalidUserByEmail(): void {
		// Grab an email that does not exist
		$user = User::getUserByUserEmail($this->getPDO(), "does@not.exist");
		$this->assertNull($user);
	}

	/**
	 * Test grabbing a user by its activation token
	 */
	public function testGetValidUserByActivationToken(): void {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USEREMAIL, $this->VALID_USERNAME, $this->VALID_PASSWORD);
		$user->insert($this->getPDO());
		// Grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserActivationToken($this->getPDO(), $user->getUserActivationToken());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USERNAME);
		$this->assertEquals($pdoUser->getUserPassword(), $this->VALID_PASSWORD);
	}

//	/**
//	 * Test grabbing a User by an email that does not exists
//	 **/
//	public function testGetInvalidUserActivation(): void {
//		// Grab an email that does not exist
//		$user = User::getUserByUserActivationToken($this->getPDO(), "6675636b646f6e616c646472756d7066");
//		$this->assertNull($user);
//	}


	/**
	 * Test grabbing all Users
	 **/
	public function testGetAllValidUsers(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new User and insert to into mySQL
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USEREMAIL, $this->VALID_USERNAME, $this->VALID_PASSWORD);
		$user->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = User::getAllUsers($this->getPDO());
        $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
        $this->assertCount(1, $results);
        $this->assertContainsOnlyInstancesOf("TheRouters\\Capstone\\User", $results);
        // grab the result from the array and validate it
        $pdoUser = $results[0];
        $this->assertEquals($pdoUser->getUserId(), $userId);
        $this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		  $this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		  $this->assertEquals($pdoUser->getUserName(), $this->VALID_USERNAME);
		  $this->assertEquals($pdoUser->getUserPassword(), $this->VALID_PASSWORD);
    }
}
