<?php
namespace TheRouters\Capstone\Test;
use TheRouters\Capstone\{
	Sign, User, UserPhoto
};
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");
/**
 * Full PHPUnit test for the Sign class
 *
 * This is a complete PHPUnit test of the Sign class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Sign
 * @author Erica Tollefson <etollefson@cnm.edu>
 **/
class SignTest extends SignsOn66Test {

	/**
	 * valid sign description to use
	 * @var string $VALID_DESCRIPTION
	 **/
	protected $VALID_DESCRIPTION = "This is a sample sign description";
	/**
	 * second valid sign description to use
	 * @var string $VALID_DESCRIPTION2
	 **/
	protected $VALID_DESCRIPTION2 = "I'm adding another sample sign description";
	/**
	 * valid sign latitude
	 * @var float $VALID_LATITUDE
	 **/
	protected $VALID_LATITUDE = 35.084385;
	/**
	 * valid sign longitude
	 * @var float $VALID_LONGITUDE
	 **/
	protected $VALID_LONGITUDE = -106.650421;
	/**
	* valid sign name to use
	 * @var string $VALID_NAME
	 **/
	protected $VALID_NAME = "The name of this sample sign is De Anza";
	/**
	 * valid sign type to use
	 * @var string $VALID_TYPE
	 **/
	protected $VALID_TYPE = "This sample sign type is orphan";

	/**
	 * test inserting a valid Sign and verify that the actual mySQL data matches
	 **/
	public function testInsertValidSign() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("sign");
		$signId = generateUuidV4();
		$sign = new Sign($signId, $this->VALID_DESCRIPTION, $this->VALID_LATITUDE, $this->VALID_LONGITUDE, $this->VALID_NAME, $this->VALID_TYPE);
		$sign->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSign = Sign::getSignBySignId($this->getPDO(), $sign->getSignId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sign"));
		$this->assertEquals($pdoSign->getSignId(), $signId);
		$this->assertEquals($pdoSign->getSignDescription(), $this->VALID_DESCRIPTION);
		$this->assertEquals($pdoSign->getSignLatitude(), $this->VALID_LATITUDE);
		$this->assertEquals($pdoSign->getSignLongitude(), $this->VALID_LONGITUDE);
		$this->assertEquals($pdoSign->getSignName(), $this->VALID_NAME);
		$this->assertEquals($pdoSign->getSignType(), $this->VALID_TYPE);
	}
	/**
	 * test inserting a Sign, editing it, and then updating it
	 **/
	public function testUpdateValidSign() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("sign");
		// create a new Sign and insert to into mySQL
		$signId = generateUuidV4();
		$sign = new Sign($signId, $this->VALID_DESCRIPTION, $this->VALID_LATITUDE,$this->VALID_LONGITUDE, $this->VALID_NAME, $this->VALID_TYPE);
		$sign->insert($this->getPDO());
		// edit the Sign and update it in mySQL
		$sign->setSignDescription($this->VALID_DESCRIPTION);
		$sign->update($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSign = Sign::getSignBySignId($this->getPDO(), $sign->getSignId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sign"));
		$this->assertEquals($pdoSign->getSignId(), $signId);
		$this->assertEquals($pdoSign->getSignDescription(), $this->VALID_DESCRIPTION);
		$this->assertEquals($pdoSign->getSignLatitude(), $this->VALID_LATITUDE);
		$this->assertEquals($pdoSign->getSignLongitude(), $this->VALID_LONGITUDE);
		$this->assertEquals($pdoSign->getSignName(), $this->VALID_NAME);
		$this->assertEquals($pdoSign->getSignType(), $this->VALID_TYPE);
	}
	/**
	 * test creating a Profile and then deleting it
	 **/
	public function testDeleteValidProfile() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		// delete the Profile from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$profile->delete($this->getPDO());
		// grab the data from mySQL and enforce the Profile does not exist
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertNull($pdoProfile);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("profile"));
	}
	/**
	 * test inserting a Profile and regrabbing it from mySQL
	 **/
	public function testGetValidProfileByProfileId() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileAtHandle(), $this->VALID_ATHANDLE);
		$this->assertEquals($pdoProfile->getProfileAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a Profile that does not exist
	 **/
	public function testGetInvalidProfileByProfileId() : void {
		// grab a profile id that exceeds the maximum allowable profile id
		$fakeProfileId = generateUuidV4();
		$profile = Profile::getProfileByProfileId($this->getPDO(), $fakeProfileId );
		$this->assertNull($profile);
	}
	public function testGetValidProfileByAtHandle() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		//grab the data from MySQL
		$results = Profile::getProfileByProfileAtHandle($this->getPDO(), $this->VALID_ATHANDLE);
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("profile"));
		//enforce no other objects are bleeding into profile
		$this->assertContainsOnlyInstancesOf("Edu\\CNM\\DataDesign\\Profile", $results);
		//enforce the results meet expectations
		$pdoProfile = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileAtHandle(), $this->VALID_ATHANDLE);
		$this->assertEquals($pdoProfile->getProfileAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a Profile by at handle that does not exist
	 **/
	public function testGetInvalidProfileByAtHandle() : void {
		// grab an at handle that does not exist
		$profile = Profile::getProfileByProfileAtHandle($this->getPDO(), "@doesnotexist");
		$this->assertCount(0, $profile);
	}
	/**
	 * test grabbing a Profile by email
	 **/
	public function testGetValidProfileByEmail() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileEmail($this->getPDO(), $profile->getProfileEmail());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileAtHandle(), $this->VALID_ATHANDLE);
		$this->assertEquals($pdoProfile->getProfileAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a Profile by an email that does not exists
	 **/
	public function testGetInvalidProfileByEmail() : void {
		// grab an email that does not exist
		$profile = Profile::getProfileByProfileEmail($this->getPDO(), "does@not.exist");
		$this->assertNull($profile);
	}
	/**
	 * test grabbing a profile by its activation
	 */
	public function testGetValidProfileByActivationToken() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileActivationToken($this->getPDO(), $profile->getProfileActivationToken());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileAtHandle(), $this->VALID_ATHANDLE);
		$this->assertEquals($pdoProfile->getProfileAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a Profile by an email that does not exists
	 **/
	public function testGetInvalidProfileActivation() : void {
		// grab an email that does not exist
		$profile = Profile::getProfileByProfileActivationToken($this->getPDO(), "6675636b646f6e616c646472756d7066");
		$this->assertNull($profile);
	}
}