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
	 * @var float $VALID_LAT
	 **/
	protected $VALID_LAT = 35.084385;
	/**
	 * valid sign longitude
	 * @var float $VALID_LONG
	 **/
	protected $VALID_LONG = -106.650421;
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
		$sign = new Sign($signId, $this->VALID_DESCRIPTION, $this->VALID_LAT, $this->VALID_LONG, $this->VALID_NAME, $this->VALID_TYPE);
		$sign->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSign = Sign::getSignBySignId($this->getPDO(), $sign->getSignId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sign"));
		$this->assertEquals($pdoSign->getSignId(), $signId);
		$this->assertEquals($pdoSign->getSignDescription(), $this->VALID_DESCRIPTION);
		$this->assertEquals($pdoSign->getSignLat(), $this->VALID_LAT);
		$this->assertEquals($pdoSign->getSignLong(), $this->VALID_LONG);
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
		$sign = new Sign($signId, $this->VALID_DESCRIPTION, $this->VALID_LAT,$this->VALID_LONG, $this->VALID_NAME, $this->VALID_TYPE);
		$sign->insert($this->getPDO());
		// edit the Sign and update it in mySQL
		$sign->setSignDescription($this->VALID_DESCRIPTION);
		$sign->update($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSign = Sign::getSignBySignId($this->getPDO(), $sign->getSignId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sign"));
		$this->assertEquals($pdoSign->getSignId(), $signId);
		$this->assertEquals($pdoSign->getSignDescription(), $this->VALID_DESCRIPTION);
		$this->assertEquals($pdoSign->getSignLatitude(), $this->VALID_LAT);
		$this->assertEquals($pdoSign->getSignLongitude(), $this->VALID_LONG);
		$this->assertEquals($pdoSign->getSignName(), $this->VALID_NAME);
		$this->assertEquals($pdoSign->getSignType(), $this->VALID_TYPE);
	}
	/**
	 * test creating a Sign and then deleting it
	 **/
	public function testDeleteValidSign() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("sign");
		$signId = generateUuidV4();
		$sign = new Sign($signId, $this->VALID_DESCRIPTION, $this->VALID_LAT, $this->VALID_LONG, $this->VALID_NAME, $this->VALID_TYPE);
		$sign->insert($this->getPDO());
		// delete the Sign from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sign"));
		$sign->delete($this->getPDO());
		// grab the data from mySQL and enforce the Sign does not exist
		$pdoSign = Sign::getSignBySignId($this->getPDO(), $sign->getSignId());
		$this->assertNull($pdoSign);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("sign"));
	}
	/**
	 * test inserting a Sign and regrabbing it from mySQL
	 **/
	public function testGetValidSignBySignId() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("sign");
		$signId = generateUuidV4();
		$sign = new Sign($signId, $this->VALID_DESCRIPTION, $this->VALID_LAT, $this->VALID_LONG, $this->VALID_NAME, $this->VALID_TYPE);
		$sign->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSign = Sign::getSignBySignId($this->getPDO(), $sign->getSignId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sign"));
		$this->assertEquals($pdoSign->getSignId(), $signId);
		$this->assertEquals($pdoSign->getSignDescription(), $this->VALID_DESCRIPTION);
		$this->assertEquals($pdoSign->getSignLat(), $this->VALID_LAT);
		$this->assertEquals($pdoSign->getSignLong(), $this->VALID_LONG);
		$this->assertEquals($pdoSign->getSignName(), $this->VALID_NAME);
		$this->assertEquals($pdoSign->getSignType(), $this->VALID_TYPE);
	}
	/**
	 * test grabbing a Sign that does not exist
	 **/
	public function testGetInvalidSignBySignId() : void {
		// grab a sign id that exceeds the maximum allowable profile id
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