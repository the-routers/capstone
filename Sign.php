<?php

namespace ;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Data for Sign class
 *
 * This is the data needs to be included in the database for information on a Sign, including an id, description, location, sign name, and sign type.
 *
 * @author Erica Tollefson <etollefson@cnm.edu>
 * @version 1.0.0
 **/

class Sign implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * id for this Sign; this is the primary key; this is unique
	 * @var Uuid $signId
	 **/
	private $signId;

	/**
	 * description of the Sign;
	 * @var string $signDescription
	 **/
	private $signDescription;

	/**
	 * location for this Sign in latitude;
	 * @var float $signLat
	 **/
	private $signLat;

	/**
	 * location for this Sign in longitude;
	 * @var float $signLong
	 **/
	private $signLong;

	/**
	 * name for this Sign;
	 * @var string $signName
	 **/
	private $signName;

	/**
	 * type for this Sign;
	 * @var string $signType
	 **/
	private $signType;


	/**
	 * constructor for this Sign
	 *
	 * @param string|Uuid $newSignId id of this Sign
	 * @param string $newSignDescription description of this Sign
	 * @param float $newSignLat float containing the latitude of this Sign
	 * @param float $newSignLong float containing the longitude of this Sign
	 * @param string $newSignName string containing name for this Sign
	 * @param string $newSignType string containing type for this Sign
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newSignId, ?string $newSignDescription, ?float $newSignLat, ?float $newSignLong, ?string $newSignName, ?string $newSignType) {
		try {
			$this->setSignId($newSignId);
			$this->setSignDescription($newSignDescription);
			$this->setSignLat($newSignLat);
			$this->setSignLong($newSignLong);
			$this->setSignName($newSignName);
			$this->setSignType($newSignType);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}





	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["signId"] = $this->signId->toString();

		return ($fields);
	}
}

?>
}