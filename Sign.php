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
	 * accessor method for sign id
	 *
	 * @return Uuid value of sign id
	 **/
	public function getSignId(): Uuid {
		return ($this->signId);
	}

	/**
	 * mutator method for sign id
	 *
	 * @param Uuid|string $newSignId new value of sign id
	 * @throws \RangeException if $newSignId is not positive
	 * @throws \TypeError if $newSignId is not a uuid or string
	 **/
	public function setSignId($newSignId): void {
		try {
			$uuid = self::validateUuid($newSignId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the sign id
		$this->signId = $uuid;
	}

	/**
	 * accessor method for sign description
	 *
	 * @return string value of sign description
	 **/
	public function getSignDescription(): string {
		return ($this->signDescription);
	}

	/**
	 * mutator method for sign description
	 *
	 * @param string $newSignDescription new value of sign description
	 * @throws \InvalidArgumentException if $newSignDescription is not a string or insecure
	 * @throws \RangeException if $newSignDescription is > 255 characters
	 * @throws \TypeError if $newSignDescription is not a string
	 **/
	public function setSignDescription(?string $newSignDescription): void {
		// verify the sign description is secure
		$newSignDescription = trim($newSignDescription);
		$newSignDescription = filter_var($newSignDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newSignDescription) === true) {
			throw(new \InvalidArgumentException("sign description is empty or insecure"));
		}
		// verify the sign description will fit in the database
		if(strlen($newSignDescription) > 255) {
			throw(new \RangeException("sign description is too large"));
		}
		// store the sign description
		$this->signDescription = $newSignDescription;
	}

	/**
	 * accessor method for sign latitude
	 *
	 * @return float value of sign latitude
	 **/
	public function getSignLat(): float {
		return ($this->signLat);
	}

	/**
	 * mutator method for sign latitude
	 *
	 * @param float $newSignLat new value of sign latitude
	 * @throws \InvalidArgumentException if the sign latitude is not a decimal value
	 * @throws \InvalidArgumentException  if the sign latitude is not a float or insecure
	 **/
	public function setSignLat(?float $newSignLat): void {
		// verify the sign latitude will fit in the database
		if(is_float($newSignLat) != true)
			throw(new \InvalidArgumentException("latitude not valid"));
		}

		// verify the sign latitude is secure
		$newSignLat = trim($newSignLat);
		$newSignLat = filter_var($newSignLat, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newSignLat) === true) {
			throw(new \InvalidArgumentException("sign latitude is empty or insecure"));
		}
		$this->SignLat = $newSignLat;
	}

/**
	 * accessor method for sign longitude
	 *
	 * @return float value of sign longitude
	 **/
	public function getSignLong(): float {
		return ($this->signLong);
	}

	/**
	 * mutator method for sign longitude
	 *
	 * @param float $newSignLong new value of sign longitude
	 * @throws \InvalidArgumentException if the sign longitude is not a decimal value
	 * @throws \InvalidArgumentException if the sign longitude is not a float or insecure
	 **/
	public function setSignLong(?float $newSignLong): void {
		// verify the sign longitude will fit in the database
		if(is_float($newSignLong) != true)
			throw(new \InvalidArgumentException("longitude not valid"));
		}

		// verify the sign longitude is secure
		$newSignLong = trim($newSignLong);
		$newSignLong = filter_var($newSignLong, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newSignLong) === true) {
			throw(new \InvalidArgumentException("sign longitude is empty or insecure"));
		}
		$this->signLong = $newSignLong;
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