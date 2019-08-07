<?php
namespace TheRouters\Capstone\Test;
use TheRouters\Capstone\{
	User, Sign, UserPhoto
};
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 1) . "/Classes/uuid.php");
/**
 * Full PHPUnit test for the Image class
 *
 * This is a complete PHPUnit test of the Image class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Image
 * @author Marty Bonacci <mbonacci@cnm.edu>
 * @modeled after TweetTest.php by Dylan McDonald <dmcdonald21@cnm.edu>
 **/
class UserPhotoTest extends SignsOn66Test {
	/**
	 * User that created  the post; this is for foreign key relations
	 * @var  User $userPhotoUserId
	 **/
	protected $userPhotoUserId = null;
	/**
	 * Sign that was liked; this is for foreign key relations
	 * @var Sign $userPhotoSignId
	 **/
	protected $userPhotoSignId = null;
	/**
	 *  this is for foreign key relations
	 * @var UserPhoto
	 **/
	protected $userPhoto = null;
	/**
	 * User use to
	 * @var $userPhotoCaption
	 */
	protected $userPhotoCaption;
	/**
	 * timestamp of the Like; this starts as null and is assigned later
	 * @var
	 **/
	protected $VALID_LIKEDATE;
	/**
	 * valid activationToken to create the profile object to own the test
	 * @var string $VALID_ACTIVATION
	 */
	protected $VALID_ACTIVATION;
	/**
	 * second valid cloudinary token  to use
	 * @var string $VALID_CLOUDINARYTOKEN
	 **/
	protected $VALID_CLOUDINARYTOKEN;
	/**
	 * valid IMAGECLOUDINARYTOKEN to create the image object to own the test
	 * @var string $VALID_IMAGECLOUDINARYTOKEN
	 */
	protected $VALID_IMAGECLOUDINARYTOKEN;
	/**
	 * valid IMAGEURL to create the image object to own the test
	 * @var string $VALID_IMAGEURL
	 */
	protected $VALID_IMAGEURL = "https://media.giphy.com/media/szxw88uS1cq4M/giphy.gif";
	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp(): void {
		// run the default setUp() method first
		parent::setUp();
		// create a salt and hash for the mocked profile
		$password = "abc123";
		$this->VALID_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));
		$this->VALID_CLOUDINARYTOKEN = bin2hex(random_bytes(125));
		$this->VALID_IMAGECLOUDINARYTOKEN = "https://media.giphy.com/media/3og0INyCmHlNylks9O/giphy.gif";
		// create and insert the mocked profile
		$this->profile = new Profile(generateUuidV4(), null, "@phpunit", $this->VALID_CLOUDINARYTOKEN, "test@phpunit.de", $this->VALID_HASH, "+12125551212");
		$this->profile->insert($this->getPDO());
		// create the and insert the mocked tweet
		$this->tweet = new Tweet(generateUuidV4(), $this->profile->getProfileId(), "PHPUnit like test passing");
		$this->tweet->insert($this->getPDO());
	}
	/**
	 * test inserting a valid Image and verify that the actual mySQL data matches
	 **/
	public function testInsertValidImage(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("image");
		// create a new Image and insert to into mySQL
		$imageId = generateUuidV4();
		$image = new Image($imageId, $this->tweet->getTweetId(), $this->VALID_IMAGECLOUDINARYTOKEN, $this->VALID_IMAGEURL);
		$image->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoImage = Image::getImageByImageId($this->getPDO(), $image->getImageId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("image"));
		$this->assertEquals($pdoImage->getImageId(), $imageId);
		$this->assertEquals($pdoImage->getImageTweetId(), $this->tweet->getTweetId());
		$this->assertEquals($pdoImage->getImageCloudinaryToken(), $this->VALID_IMAGECLOUDINARYTOKEN);
		$this->assertEquals($pdoImage->getImageUrl(), $this->VALID_IMAGEURL);
	}
	/**
	 * test creating an Image and then deleting it
	 **/
	public function testDeleteValidImage(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("image");
		// create a new Image and insert to into mySQL
		$imageId = generateUuidV4();
		$image = new Image($imageId, $this->tweet->getTweetId(), $this->VALID_IMAGECLOUDINARYTOKEN, $this->VALID_IMAGEURL);
		$image->insert($this->getPDO());
		// delete the Image from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("image"));
		$image->delete($this->getPDO());
		// grab the data from mySQL and enforce the Image does not exist
		$pdoImage = Image::getImageByImageId($this->getPDO(), $image->getImageId());
		$this->assertNull($pdoImage);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("image"));
	}
	/**
	 * test grabbing a Image that does not exist
	 **/
	public function testGetImageByImageId() {
		// grab a tweet id and profile id that exceeds the maximum allowable tweet id and profile id
		$image = Image::getImageByImageId($this->getPDO(), generateUuidV4());
		$this->assertNull($image);
	}
	/**
	 * test grabbing an Image by tweet id
	 **/
	public function testGetValidImageByTweetId(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("image");
		// create a new Image and insert to into mySQL
		$imageId = generateUuidV4();
		$image = new Image($imageId, $this->tweet->getTweetId(), $this->VALID_IMAGECLOUDINARYTOKEN, $this->VALID_IMAGEURL);
		$image->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoImage = Image::getImageByImageTweetId($this->getPDO(), $this->tweet->getTweetId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("image"));
		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DataDesign\\Image", $pdoImage);
	}
	/**
	 * test grabbing a Image by a tweet id that does not exist
	 **/
	public function testGetInvalidImageByTweetId(): void {
		// grab a tweet id that exceeds the maximum allowable tweet id
		$image = Image::getImageByImageTweetId($this->getPDO(), generateUuidV4());
		$this->assertCount(0, $image);
	}
	/**
	 * test grabbing an Image by profile id
	 **/
	public function testGetValidImageByProfileId(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("image");
		// create a new Image and insert to into mySQL
		$imageId = generateUuidV4();
		$image = new Image($imageId, $this->tweet->getTweetId(), $this->VALID_IMAGECLOUDINARYTOKEN, $this->VALID_IMAGEURL);
		$image->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoImage = Image::getImageByProfileId($this->getPDO(), $this->tweet->getTweetId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("image"));
		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DataDesign\\Like", $pdoImage);
	}
	/**
	 * test grabbing a Image by a tweet id that does not exist
	 **/
	public function testGetInvalidImageByProfileId(): void {
		// grab a profile id that exceeds the maximum allowable profile id
		$image = Image::getImageByProfileId($this->getPDO(), generateUuidV4());
		$this->assertCount(0, $image);
	}
}