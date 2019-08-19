<?php
namespace TheRouters\Capstone\Test;
use TheRouters\Capstone\{
	UserPhoto, Sign, User
};
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__,2) . "/lib/uuid.php");
/**
 * Full PHPUnit test for the UserPhoto class
 *
 * This is a complete PHPUnit test of the UserPhoto class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see UserPhoto
 * @author Rishita<rhariyani@cnm.edu>
 * @modeled after TweetTest.php by Dylan McDonald <dmcdonald21@cnm.edu>
 **/
class UserPhotoTest extends SignsOn66Test {
	/* User that created  the post; this is for foreign key relations
	* @var  User $userPhotoUserId
	**/
	protected $user;

	/* valid hash to use create object of user
		 * @var $VALID_UserHash
		 */
	protected $VALID_USERHASH;
	/**
	 * valid activationToken to create the user object to own the test
	 * @var string $VALID_ACTIVATION
	 */
	protected $VALID_ACTIVATION;
	/**
	 * Sign that was created; this is for foreign key relations
	 * @var Sign $userPhotoSignId
	 **/
	protected $sign;
	/**
	 *  this is where user input caption for photo
	 * @var  string / null $userPhotoCaption
	 **/
	protected $VALID_USERPHOTOCAPTION = "Abvfhvhgvhv";
	/**
	 * User use to determine photo uploaded is featured or not
	 * @var bool $VALID_USERPHOTOISFEATURE
	 */
	protected $VALID_USERPHOTOISFEATURE = 1;
	/**
	 * user use to photoUrl to store sign photo
	 * @var  string $userPhotoUrl
	 **/
	protected $VALID_USERPHOTOURL = "https://media.giphy.com/media/szxw88uS1cq4M/giphy.gif";

	/**
	 * create dependent objects before running each test
	 **/

	public final function setUp(): void {
		// run the default setUp() method first
		parent::setUp();
		// create a salt and hash for the mocked user
		$password = "abc123";
		$this->VALID_USERHASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));

		// create and insert a user to own the test
		$this->user = new User(generateUuidV4(), $this->VALID_ACTIVATION,"router@test.com","john", $this->VALID_USERHASH);
		$this->user->insert($this->getPDO());

		// create and insert a user to own the test sign
		$this->sign = new Sign(generateUuidV4(),"hello", 35.0002 , 100.2222, "name", "orphan");
		$this->sign->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Image and verify that the actual mySQL data matches
	 **/
	public function testInsertValidUserPhoto(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("userPhoto");
		// create a new UserPhoto and insert to into mySQL
		$userPhotoId = generateUuidV4();
		$userPhoto = new UserPhoto($userPhotoId, $this->sign->getSignId(), $this->user->getUserId(),
			$this->VALID_USERPHOTOCAPTION, $this->VALID_USERPHOTOISFEATURE, $this->VALID_USERPHOTOURL);
		$userPhoto->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUserPhoto = UserPhoto::getUserPhotoByUserPhotoId($this->getPDO(), $userPhoto->getUserPhotoId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("userPhoto"));
		$this->assertEquals($pdoUserPhoto->getUserPhotoId(), $userPhotoId);
		$this->assertEquals($pdoUserPhoto->getUserPhotoSignId(), $this->sign->getSignId());
		$this->assertEquals($pdoUserPhoto->getUserPhotoUserId(), $this->user->getUserId());
		$this->assertEquals($pdoUserPhoto->getUserPhotoCaption(), $this->VALID_USERPHOTOCAPTION);
		$this->assertEquals($pdoUserPhoto->getUserPhotoIsFeature(), $this->VALID_USERPHOTOISFEATURE);
		$this->assertEquals($pdoUserPhoto->getUserPhotoUrl(), $this->VALID_USERPHOTOURL);

	}

	/**
	 * test creating an photo and then deleting it
	 **/
	public function testDeleteValidUserPhoto(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("userPhoto");
		// create a new photo and insert to into mySQL
		$userPhotoId = generateUuidV4();
		$userPhoto = new UserPhoto($userPhotoId,$this->sign->getSignId(), $this->user->getUserId(),
			$this->VALID_USERPHOTOCAPTION, $this->VALID_USERPHOTOISFEATURE, $this->VALID_USERPHOTOURL);
		$userPhoto->insert($this->getPDO());
		// delete the photo from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("userPhoto"));
		$userPhoto->delete($this->getPDO());
		// grab the data from mySQL and enforce the photo does not exist
		$pdoUserPhoto = UserPhoto::getUserPhotoByUserPhotoId($this->getPDO(), $userPhoto->getUserPhotoId());
		$this->assertNull($pdoUserPhoto);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("userPhoto"));
	}



	/**
	 * test grabbing an photo by sign id
	 **/
	public function testGetValidUserPhotoByUserPhotoSignId(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("userPhoto");
		// create a new photo and insert to into mySQL
		$userPhotoId = generateUuidV4();
		$userPhoto = new UserPhoto($userPhotoId, $this->sign->getSignId(),$this->user->getUserId(),
			$this->VALID_USERPHOTOCAPTION, $this->VALID_USERPHOTOISFEATURE, $this->VALID_USERPHOTOURL);
		$userPhoto->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUserPhoto = UserPhoto::getUserPhotoByUserPhotoSignId($this->getPDO(), $this->sign->getSignId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("userPhoto"));
		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("TheRouters\\Capstone\\UserPhoto", $pdoUserPhoto);
	}


	/**
	 * test grabbing an photo by user id
	 **/
	public function testGetValidUserPhotoByUserPhotoUserId(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("userPhoto");
		// create a new photo and insert to into mySQL
		$userPhotoId = generateUuidV4();
		$userPhoto = new UserPhoto($userPhotoId, $this->sign->getSignId(), $this->user->getUserId(),
			$this->VALID_USERPHOTOCAPTION, $this->VALID_USERPHOTOISFEATURE, $this->VALID_USERPHOTOURL);
		$userPhoto->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUserPhoto = UserPhoto::getUserPhotoByUserPhotoUserId($this->getPDO(), $this->user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("userPhoto"));
		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("TheRouters\\Capstone\\UserPhoto", $pdoUserPhoto);
	}



	/**
	 * test grabbing all Photos
	 **/
	public function testGetAllValidAllUserPhotos(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("userPhoto");
		// create a new Sign and insert to into mySQL
		$userPhotoId = generateUuidV4();
		$userPhoto = new UserPhoto($userPhotoId, $this->sign->getSignId(), $this->user->getUserId(),
			$this->VALID_USERPHOTOCAPTION, $this->VALID_USERPHOTOISFEATURE, $this->VALID_USERPHOTOURL);
		$userPhoto->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = UserPhoto::getAllUserPhotos($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("userPhoto"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("TheRouters\Capstone\\UserPhoto", $results);
		// grab the result from the array and validate it
		$pdoUserPhoto = $results[0];
		$this->assertEquals($pdoUserPhoto->getUserPhotoId(), $userPhotoId);
		$this->assertEquals($pdoUserPhoto->getUserPhotoSignId(), $this->sign->getSignId());
		$this->assertEquals($pdoUserPhoto->getUserPhotoUserId(), $this->user->getUserId());
		$this->assertEquals($pdoUserPhoto->getUserPhotoCaption(), $this->VALID_USERPHOTOCAPTION);
		$this->assertEquals($pdoUserPhoto->getUserPhotoIsFeature(), $this->VALID_USERPHOTOISFEATURE);
		$this->assertEquals($pdoUserPhoto->getUserPhotoUrl(), $this->VALID_USERPHOTOURL);
	}
	/**
	 * test grabbing an photo by IsFeature or not
	 **/
	public function testGetValidUserPhotoByUserPhotoIsFeature(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("userPhoto");
		// create a new photo and insert to into mySQL
		$userPhotoId = generateUuidV4();
		$userPhoto = new UserPhoto($userPhotoId, $this->sign->getSignId(), $this->user->getUserId(),
			$this->VALID_USERPHOTOCAPTION, $this->VALID_USERPHOTOISFEATURE, $this->VALID_USERPHOTOURL);
		$userPhoto->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUserPhoto = UserPhoto::getUserPhotoByUserPhotoIsFeature($this->getPDO(), $userPhoto->getUserPhotoIsFeature());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("userPhoto"));
		$this->assertCount(1, $pdoUserPhoto);
		$this->assertContainsOnlyInstancesOf("TheRouters\Capstone\\UserPhoto", $pdoUserPhoto);
		// grab the result from the array and validate it
		$pdoUserPhoto = $pdoUserPhoto[0];
		$this->assertEquals($pdoUserPhoto->getUserPhotoId(), $userPhotoId);
		$this->assertEquals($pdoUserPhoto->getUserPhotoSignId(), $this->sign->getSignId());
		$this->assertEquals($pdoUserPhoto->getUserPhotoUserId(), $this->user->getUserId());
		$this->assertEquals($pdoUserPhoto->getUserPhotoCaption(), $this->VALID_USERPHOTOCAPTION);
		$this->assertEquals($pdoUserPhoto->getUserPhotoIsFeature(), $this->VALID_USERPHOTOISFEATURE);
		$this->assertEquals($pdoUserPhoto->getUserPhotoUrl(), $this->VALID_USERPHOTOURL);
	}

	}