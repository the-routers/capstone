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

	protected $VALID_NAME = "De Anza";
	/**
	 * valid sign type to use
	 * @var string $VALID_TYPE
	 **/
	protected $VALID_TYPE = "Orphan";

	/**
	 * test inserting a valid Sign and verify that the actual mySQL data matches
	 **/
	public function testInsertValidSign(): void {
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
		$sign = new Sign($signId, $this->VALID_DESCRIPTION, $this->VALID_LAT, $this->VALID_LONG, $this->VALID_NAME, $this->VALID_TYPE);
		$sign->insert($this->getPDO());
		// edit the Sign and update it in mySQL
		$sign->setSignDescription($this->VALID_DESCRIPTION);
		$sign->update($this->getPDO());
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
	 * test creating a Sign and then deleting it
	 **/
	public function testDeleteValidSign(): void {
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
	public function testGetValidSignBySignId(): void {
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
	public function testGetInvalidSignBySignId(): void {
		// grab a sign id that exceeds the maximum allowable sign id
		$fakeSignId = generateUuidV4();
		$sign = Sign::getSignBySignId($this->getPDO(), $fakeSignId);
		$this->assertNull($sign);
	}

	/**
	 * test grabbing a Sign by its Id
	 */
	public function testGetValidSignById(): void {
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


	public function testGetValidSignByName() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("sign");
		$signId = generateUuidV4();
		$sign = new Sign($signId, $this->VALID_DESCRIPTION, $this->VALID_LAT, $this->VALID_LONG, $this->VALID_NAME, $this->VALID_TYPE);
		$sign->insert($this->getPDO());
		//grab the data from MySQL
		$results = Sign::getSignBySignName($this->getPDO(), $this->VALID_NAME);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sign"));
		//enforce no other objects are bleeding into sign
		$this->assertContainsOnlyInstancesOf("TheRouters\\Capstone\\Sign", $results);
		//enforce the results meet expectations
		$pdoSign = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sign"));
		$this->assertEquals($pdoSign->getSignId(), $signId);
		$this->assertEquals($pdoSign->getSignDescription(), $this->VALID_DESCRIPTION);
		$this->assertEquals($pdoSign->getSignLat(), $this->VALID_LAT);
		$this->assertEquals($pdoSign->getSignLong(), $this->VALID_LONG);
		$this->assertEquals($pdoSign->getSignName(), $this->VALID_NAME);
		$this->assertEquals($pdoSign->getSignType(), $this->VALID_TYPE);
	}

	/* * test grabbing a Sign by type
	 **/
	public function testGetValidSignByType(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("sign");
		$signId = generateUuidV4();
		$sign = new Sign($signId, $this->VALID_DESCRIPTION, $this->VALID_LAT, $this->VALID_LONG, $this->VALID_NAME, $this->VALID_TYPE);
		$sign->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSign = Sign::getSignBySignType($this->getPDO(), $sign->getSignType());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sign"));
		$this->assertEquals($pdoSign->getSignId(), $signId);
		$this->assertEquals($pdoSign->getSignDescription(), $this->VALID_DESCRIPTION);
		$this->assertEquals($pdoSign->getSignLat(), $this->VALID_LAT);
		$this->assertEquals($pdoSign->getSignLong(), $this->VALID_LONG);
		$this->assertEquals($pdoSign->getSignName(), $this->VALID_NAME);
		$this->assertEquals($pdoSign->getSignType(), $this->VALID_TYPE);
	}

	/**
	 * test grabbing a Sign by a type that does not exist
	 **/
	public function testGetInvalidSignByType(): void {
		// grab a sign type that does not exist
		$sign = Sign::getSignBySignType($this->getPDO(), "typedoesnotexist");
		$this->assertNull($sign);
	}

	/**
	 * test grabbing all Signs
	 **/
	public function testGetAllValidSigns(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("sign");
		// create a new Sign and insert to into mySQL
		$signId = generateUuidV4();
		$sign = new Sign($signId, $this->VALID_DESCRIPTION, $this->VALID_LAT, $this->VALID_LONG, $this->VALID_NAME, $this->VALID_TYPE);
		$sign->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Sign::getAllSigns($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sign"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("TheRouters\\Capstone\\Sign", $results);
		// grab the result from the array and validate it
		$pdoSign = $results[0];
		$this->assertEquals($pdoSign->getSignId(), $signId);
		$this->assertEquals($pdoSign->getSignDescription(), $this->VALID_DESCRIPTION);
		$this->assertEquals($pdoSign->getSignLat(), $this->VALID_LAT);
		$this->assertEquals($pdoSign->getSignLong(), $this->VALID_LONG);
		$this->assertEquals($pdoSign->getSignName(), $this->VALID_NAME);
		$this->assertEquals($pdoSign->getSignType(), $this->VALID_TYPE);
	}
}