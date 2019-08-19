<?php

namespace TheRouters\Capstone;

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
	public function __construct($newSignId, string $newSignDescription, float $newSignLat, float $newSignLong, string $newSignName, ?string $newSignType) {
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
	public function setSignDescription(string $newSignDescription): void {
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
	 * @throws \RangeException  if the sign latitude is not within range of -90 to 90
	 **/
	public function setSignLat(float $newSignLat): void {
		// verify the latitude is in range
		if(floatval($newSignLat) < -90) {
			throw(new \RangeException("latitude is not between -90 and 90"));
		}
		if(floatval($newSignLat) > 90) {
			throw(new \RangeException("latitude is not between -90 and 90"));
		}
		$this->signLat = $newSignLat;
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
	public function setSignLong(float $newSignLong): void {
		// verify the longitude is in range
		if(floatval($newSignLong) < -180) {
			throw(new \RangeException("longitude is not between -180 and 180"));
		}
		if(floatval($newSignLong) > 180) {
			throw(new \RangeException("longitude is not between -180 and 180"));
		}
		$this->signLong = $newSignLong;
	}

	/**
	 * accessor method for sign name
	 *
	 * @return string value of sign name
	 **/
	public function getSignName(): string {
		return ($this->signName);
	}

	/**
	 * mutator method for sign name
	 *
	 * @param string $newSignName new value of sign name
	 * @throws \InvalidArgumentException if $newSignName is not a string or insecure
	 * @throws \RangeException if $newSignName is > 75 characters
	 * @throws \TypeError if $newSignName is not a string
	 **/
	public function setSignName(string $newSignName): void {
		// verify the sign name is secure
		$newSignName = trim($newSignName);
		$newSignName = filter_var($newSignName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newSignName) === true) {
			throw(new \InvalidArgumentException("sign name is empty or insecure"));
		}
		// verify the sign name will fit in the database
		if(strlen($newSignName) > 75) {
			throw(new \RangeException("sign name is too large"));
		}
		// store the sign name
		$this->signName = $newSignName;
	}

	/**
	 * accessor method for sign type
	 *
	 * @return string value of sign type
	 **/
	public function getSignType(): string {
		return ($this->signType);
	}

	/**
	 * mutator method for sign type
	 *
	 * @param string $newSignType new value of sign type
	 * @throws \InvalidArgumentException if $newSignType is not a string or insecure
	 * @throws \RangeException if $newSignType is > 15 characters
	 * @throws \TypeError if $newSignType is not a string
	 **/
	public function setSignType(string $newSignType): void {
		// verify the sign type is secure
		$newSignType = trim($newSignType);
		$newSignType = filter_var($newSignType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newSignType) === true) {
			throw(new \InvalidArgumentException("sign type is empty or insecure"));
		}
		// verify the sign type will fit in the database
		if(strlen($newSignType) > 15) {
			throw(new \RangeException("sign type is too large"));
		}
		// store the sign name
		$this->signType = $newSignType;
	}

	/**
	 * inserts this Sign into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO sign(signId, signDescription, signLat, signLong, signName, signType) VALUES (:signId, :signDescription, :signLat, :signLong, :signName, :signType)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["signId" => $this->signId->getBytes(), "signDescription" => $this->signDescription, "signLat" => $this->signLat, "signLong" => $this->signLong, "signName" => $this->signName, "signType" => $this->signType];
		$statement->execute($parameters);
	}


	/**
	 * deletes this Sign from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM sign WHERE signId = :signId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["signId" => $this->signId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this Sign in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE sign SET signDescription = :signDescription, signLat = :signLat, signLong = :signLong, signName = :signName, signType = :signType WHERE signId = :signId";
		$statement = $pdo->prepare($query);


		$parameters = ["signId" => $this->signId->getBytes(),"signDescription" => $this->signDescription, "signLat" => $this->signLat, "signLong" => $this->signLong, "signName" => $this->signName, "signType" => $this->signType];
		$statement->execute($parameters);
	}

	/**
	 * gets all Signs
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Signs found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllSigns(\PDO $pdo) : \SPLFixedArray {
		// create query template
		$query = "SELECT signId, signDescription, signLat, signLong, signName, signType FROM sign";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of signs
		$signs = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$sign = new Sign($row["signId"], $row["signDescription"], $row["signLat"], $row["signLong"], $row["signName"], $row["signType"]);
				$signs[$signs->key()] = $sign;
				$signs->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($signs);
	}

	/**
	 * gets the Sign by signName
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $signName signName to search for
	 * @return \SPLFixedArray of all Signs found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getSignBySignName(\PDO $pdo, string $signName): \SPLFixedArray {
		//This sanitizes the name before searching
		$signName = trim($signName);
		$signName = filter_var($signName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($signName) === true) {
			throw(new \PDOException("not a valid sign name"));
		}
		//This creates the query template
		$query = "SELECT  signId, signDescription, signLat, signLong, signName, signType  FROM sign WHERE signName = :signName";
		$statement = $pdo->prepare($query);

		//This binds the sign name to the place holder in the template
		$parameters = ["signName" => $signName];
		$statement->execute($parameters);
		$signs = new \SPLFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$sign = new Sign($row["signId"], $row["signDescription"], $row["signLat"], $row["signLong"], $row["signName"], $row["signType"]);
				$signs[$signs->key()] = $sign;
				$signs->next();
			} catch(\Exception $exception) {

				//If the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($signs);
	}

	/**
	 * gets the Sign by signType
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $signType sign type to search for
	 * @return Sign|null Sign found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getSignBySignType(\PDO $pdo, $signType) : \SPLFixedArray {
		// sanitize the sign type before searching
		$signType = trim($signType);
		$signType = filter_var($signType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($signType) === true) {
			throw(new \PDOException("sign type is invalid"));
		}

		// create query template
		$query = "SELECT signId, signDescription, signLat, signLong, signName, signType FROM sign WHERE signType = :signType";
		$statement = $pdo->prepare($query);

		// bind the sign type to the place holder in the template
		$parameters = ["signType" => $signType];
		$statement->execute($parameters);

		// build an array of signs
		$signs = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		// grab the sign from mySQL
		try {
			$sign = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$signs = new Sign($row["signId"], $row["signDescription"], $row["signLat"], $row["signLong"], $row["signName"], $row["signType"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($signs);
	}

	/**
	 * gets the Sign by signId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $signId sign id to search for
	 * @return Sign|null Sign found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getSignBySignId(\PDO $pdo, $signId) : ?Sign {
		// sanitize the signId before searching
		try {
			$signId = self::validateUuid($signId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT signId, signDescription, signLat, signLong, signName, signType FROM sign WHERE signId = :signId";
		$statement = $pdo->prepare($query);
		// bind the sign name to the place holder in the template
		$parameters = ["signId" => $signId->getBytes()];
		$statement->execute($parameters);

		// grab the sign from mySQL
		try {
			$sign = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$sign = new Sign($row["signId"], $row["signDescription"], $row["signLat"], $row["signLong"], $row["signName"], $row["signType"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($sign);
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
