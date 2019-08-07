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

	protected $VALID_ACTIVATION;
	/**
	 * Valid username to use
	 * @var string $VALID_USERNAME
	 **/

	protected $VALID_USERNAME = "@phpunit";
	/**
	 * Second valid username to use
	 * @var string $VALID_USERNAME2
	 **/

	protected $VALID_USERNAME2 = "@passingtests";
	/**
	 * Valid email to use
	 * @var string $VALID_USEREMAIL
	 **/

	protected $VALID_USEREMAIL = "test@phpunit.de";

	/**
	 * Valid password to use
	 * @var $VALID_PASSWORD
	 */
	protected $VALID_PASSWORD;



	/**
	 * Run the default setup operation to create salt and hash.
	 */
	public final function setUp() : void {
		parent::setUp();
		//
		$password = "abc123";
		$this->VALID_PASSWORD = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));
	}
	/**
	 * Test inserting a valid User and verify that the actual mySQL data matches
	 **/
	public function testInsertValidUser() : void {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USERNAME, $this->VALID_USEREMAIL, $this->VALID_PASSWORD);
		$user->insert($this->getPDO());
		// Grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserProfileByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USERNAME);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserPassword(), $this->VALID_PASSWORD);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
	}
	/**
	 * Test inserting a User, editing it, and then updating it
	 **/
	public function testUpdateValidUser() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// Create a new User and insert to into mySQL
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USERNAME,$this->VALID_USEREMAIL, $this->VALID_PASSWORD);
		$user->insert($this->getPDO());
		// Edit the Profile and update it in mySQL
		$user->setUserName($this->VALID_USERNAME);
		$user->update($this->getPDO());
		// Grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoProfile->getUserId(), $userId);
		$this->assertEquals($pdoProfile->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getUserName(), $this->VALID_USERNAME2);
		$this->assertEquals($pdoProfile->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoProfile->getUserPassword(), $this->VALID_PASSWORD);
	}
	/**
	 * Test creating a User and then deleting it
	 **/
	public function testDeleteValidUser() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_USER_AVATAR_URL, $this->VALID_USEREMAIL, $this->VALID_PASSWORD, $this->VALID_PHONE);
		$user->insert($this->getPDO());
		// delete the User from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$user->delete($this->getPDO());
		// grab the data from mySQL and enforce the User does not exist
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertNull($pdoUser);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("user"));
	}
	/**
	 * test inserting a User and regrabbing it from mySQL
	 **/
	public function testGetValidUserByUserId() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_USEREMAIL, $this->VALID_PASSWORD, $this->VALID_PHONE);
		$user->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserAtHandle(), $this->VALID_ATHANDLE);
		$this->assertEquals($pdoUser->getUserAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_PASSWORD);
		$this->assertEquals($pdoUser->getUserPhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a User that does not exist
	 **/
	public function testGetInvalidUserByUserId() : void {
		// grab a user id that exceeds the maximum allowable user id
		$fakeUserId = generateUuidV4();
		$user = User::getUserByUserId($this->getPDO(), $fakeUserId );
		$this->assertNull($user);
	}
	public function testGetValidUserByAtHandle() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_USEREMAIL, $this->VALID_PASSWORD, $this->VALID_PHONE);
		$user->insert($this->getPDO());
		//grab the data from MySQL
		$results = User::getUserByUserAtHandle($this->getPDO(), $this->VALID_ATHANDLE);
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("user"));
		//enforce no other objects are bleeding into user
		$this->assertContainsOnlyInstancesOf("Edu\\CNM\\DataDesign\\User", $results);
		//enforce the results meet expectations
		$pdoUser = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserAtHandle(), $this->VALID_ATHANDLE);
		$this->assertEquals($pdoUser->getUserAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_PASSWORD);
		$this->assertEquals($pdoUser->getUserPhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a User by username that does not exist
	 **/
	public function testGetInvalidUserByAtHandle() : void {
		// grab an username that does not exist
		$user = User::getUserByUserAtHandle($this->getPDO(), "@doesnotexist");
		$this->assertCount(0, $user);
	}
	/**
	 * test grabbing a User by email
	 **/
	public function testGetValidUserByEmail() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USERNAME, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_USEREMAIL, $this->VALID_PASSWORD, $this->VALID_PHONE);
		$user->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserEmail($this->getPDO(), $user->getUserEmail());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserAtHandle(), $this->VALID_USERNAME);
		$this->assertEquals($pdoUser->getUserAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_PASSWORD);
		$this->assertEquals($pdoUser->getUserPhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a User by an email that does not exists
	 **/
	public function testGetInvalidUserByEmail() : void {
		// grab an email that does not exist
		$user = User::getUserByUserEmail($this->getPDO(), "does@not.exist");
		$this->assertNull($user);
	}
	/**
	 * test grabbing a user by its activation
	 */
	public function testGetValidUserByActivationToken() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_USERNAME, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_USEREMAIL, $this->VALID_PASSWORD, $this->VALID_PHONE);
		$user->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserActivationToken($this->getPDO(), $user->getUserActivationToken());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserAtHandle(), $this->VALID_USERNAME);
		$this->assertEquals($pdoUser->getUserAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_PASSWORD);
		$this->assertEquals($pdoUser->getUserPhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a User by an email that does not exists
	 **/
	public function testGetInvalidUserActivation() : void {
		// grab an email that does not exist
		$user = User::getUserByUserActivationToken($this->getPDO(), "6675636b646f6e616c646472756d7066");
		$this->assertNull($user);
	}
}