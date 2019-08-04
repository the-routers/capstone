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
	 * @var string $signLat
	 **/
	private $signLat;

	/**
	 * location for this Sign in longitude;
	 * @var string $signLong
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