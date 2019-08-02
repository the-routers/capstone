<?php
/**
 * This is about userPhoto table.Here is declaration of all state variables
 */
namespace Rhariyani\capstone;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class  userPhoto implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * id for this userPhoto; this is the primary key
	 * @var Uuid $userPhotoID
	 **/
	/**
	 * id for the userPhoto is primary key
	 */
private $userPhotoId;
/**
* id of the user table that link user to photo; this is a foreign key
* @var Uuid $userPhotoUserId
	 **/

private $userPhotoUserId;
	/**
	 * id of the sign table that link photos to each sign ; this is a foreign key
	 * @var Uuid $userPhotoSignId
	 **/

	private $userPhotoSignId;
	/**
	 * this attribute of userPhoto table that contains caption for user and description for
	 * photos to each sign ;
	 * @var Uuid $userPhotoCaption
	 **/
private $userPhotoCaption;
	/**
	 * this attribute of userPhoto table that will be boolean value
	 * for each photos if it is featured or not;
	 * @var  boolean $userPhotoIsFeature
	 **/
private $userPhotoIsFeature;
/**
* this attribute of userPhoto table that allow to store photo uploaded by each user;
* @var Uuid $userPhotoUrl
	 **/
private $userPhotoUrl;



/**
* constructor for this userPhoto
*
* @param string|Uuid $newUserPhotoId id of this UserPhoto
* @param string|Uuid $newUserPhotoUserId id of the user table
 * @param string|Uuid $newUserPhotoSignId id of the sign table
 * @param string $newUserPhotoCaption string containing actual  data for photo
 * @param boolean $newUserPhotoIsFeature (1) contain data is featured or not.
 * @param string $newUserPhotoUrl string containing actual  link  for photo
 * @throws \InvalidArgumentException if data types are not valid
* @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
* @throws \TypeError if data types violate type hints
* @throws \Exception if some other exception occurs
* @Documentation https://php.net/manual/en/language.oop5.decon.php
**/
	public function __construct($newUserPhotoId, $newUserPhotoUserId, $newUserPhotoSignId, $newUserPhotoCaption, $newUserPhotoIsFeature, $newUserPhotoUrl = null) {
		try {
			$this->setUserPhotoId($newUserPhotoId);
			$this->setUserPhotoUserId($newUserPhotoUserId);
			$this->setUserPhotoSignId($newUserPhotoSignId);
			$this->setUserPhotoCaption($newUserPhotoCaption);
			$this->setUserPhotoIsFeature($newUserPhotoIsFeature);
			$this->setUserPhotoUrl($newUserPhotoUrl);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for userPhoto id
	 *
	 * @return Uuid value of userPhoto id
	 **/
	public function getUserPhotoId() : Uuid {
		return($this->userPhotoId);
	}

	/**
	 * mutator method for userPhoto id
	 *
	 * @param Uuid|string $newUserPhotoID new value of userPhotoId
	 * @throws \RangeException if $newUserPhoto is not positive
	 * @throws \TypeError if $newUserPhoto is not a uuid or string
	 **/
	public function setUserPhotoId( $newUserPhotoID) : void {
		try {
			$uuid = self::validateUuid($newUserPhotoID);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the userPhoto id
		$this->userPhotoId = $uuid;
	}

	/**
	 * accessor method for user  id this is foreign key
	 *
	 * @return Uuid value of userPhoto id
	 **/
	public function getUserPhotoUserId() : Uuid{
		return($this->userPhotoUserId);
	}

	/**
	 * mutator method for user photo id
	 *
	 * @param string | Uuid $newUserPhotoUserId new value of user  id
	 * @throws \RangeException if $newUserPhotoUserId is not positive
	 * @throws \TypeError if $newUserPhotoUserId is not an integer
	 **/
	public function setUserPhotoUserId( $newUserPhotoUserId) : void {
		try {
			$uuid = self::validateUuid($newUserPhotoUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the userPhoto id
		$this->userPhotoUserId = $uuid;
	}

	/**
	 * accessor method for sign id this is foreign key
	 *
	 * @return Uuid value of userPhotoSign id
	 **/
	public function getUserPhotoSignId() : Uuid{
		return($this->userPhotoSignId);
	}

	/**
	 * mutator method for user photo sign id
	 *
	 * @param string | Uuid $newUserPhotoSignId new value of user  id
	 * @throws \RangeException if $newUserPhotoSignId is not positive
	 * @throws \TypeError if $newUserPhotoSignId is not an integer
	 **/
	public function setUserPhotoSignId( $newUserPhotoSignId) : void {
		try {
			$uuid = self::validateUuid($newUserPhotoSignId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the userPhoto id
		$this->userPhotoSignId = $uuid;
	}

	/**
	 * accessor method for userPhotoCaption content
	 *
	 * @return string value of  content
	 **/
	public function getUserPhotoCaption() : string {
		return($this->userPhotoCaption);
	}

	/**
	 * mutator method for userPhotoCaption content
	 *
	 * @param string $newUserPhotoCaption new value of userPhotoCaption content
	 * @throws \InvalidArgumentException if $newUserPhotoCaption is not a string or insecure
	 * @throws \RangeException if $newUserPhotoCaption is > 140 characters
	 * @throws \TypeError if $newUserPhotoCaption is not a string
	 **/
	public function setUserPhotoCaption(string $newUserPhotoCaption) : void {
		// verify the content is secure
		$newUserPhotoCaption = trim($newUserPhotoCaption);
		$newUserPhotoCaption = filter_var($newUserPhotoCaption, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserPhotoCaption) === true) {
			throw(new \InvalidArgumentException("Caption content is empty or insecure"));
		}

		// verify the content will fit in the database
		if(strlen($newUserPhotoCaption) > 140) {
			throw(new \RangeException("Caption is too large"));
		}

		// store the content
		$this->userPhotoCaption = $newUserPhotoCaption;
	}

	/**
	 * accessor method for userPhotoIsFeature content
	 *
	 * @return boolean value of  content
	 **/
	public function getUserPhotoIsFeature() : bool {
		return($this->userPhotoIsFeature);
}
	public function setUserPhotoIsFeature(bool $newUserPhotoIsFeature): void {
		/** verify the value will fit in the database**/
		if(is_bool($newUserPhotoIsFeature) == 0) {
			throw(new \RangeException("Image is not featured"));
		}
		// store the image  content
		$this->userPhotoIsFeature = $newUserPhotoIsFeature;
	}

		/**
		 * accessor method for userPhotoUrl content
		 *
		 * @return string  value of  content
		 **/

		public function getUserPhotoUrl(): string {
			return ($this->userPhotoUrl);
		}

		/**
		 * mutator method for at handle
		 *
		 * @param string $newUserPhotoUrl new value of photo URL
		 * @throws \InvalidArgumentException if $newUserPhotoUrl is not a string or insecure
		 * @throws \RangeException if $newUserPhotoUrl is > 255 characters
		 * @throws \TypeError if $newAtHandle is not a string
		 **/
		public function setUserPhotoUrl(string $newUserPhotoUrl): void {
			$newUserPhotoUrl = trim($newUserPhotoUrl);
			$newUserPhotoUrl = filter_var($newUserPhotoUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			// verify the  URL will fit in the database
			if(strlen($newUserPhotoUrl) > 255) {
				throw(new \RangeException("Image content too large"));
			}
			// store the image  content
			$this->userPhotoUrl = $newUserPhotoUrl;
		}


	/**
	 * inserts this userPhoto into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO userPhoto(userPhotoId, UserPhotoSignId, userPhotoUserId, userPhotoCaption, userPhotoIsFeature, userPhotoUrl) 
   VALUES(:UserPhotoId, :userPhotoSignId, :userPhotoUserId, :userPhotoCaption, :userPhotoIsFeature, :userPhotoUrl)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["userPhotoId" => $this->userPhotoId->getBytes(), "userPhotoSignId" => $this->userPhotoSignId,
			"userPhotoUserId" => $this->userPhotoUserId,"userPhotoCaption"=> $this->userPhotoCaption,
			"userPhotoIsFeature" => $this->userPhotoIsFeature, "userPhotoUrl" => $this->userPhotoUrl];
		$statement->execute($parameters);
	}

	/**
	 * deletes this userPhoto from mySQL
	 *S
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM userPhoto WHERE userPhotoID = :userPhotoID";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["userPhotoID" => $this->userPhotoId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * updates this userphoto in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE userPhoto SET userPhotoCaption = :userPhotoCaption, userPhotoIsFeature = :userPhotoIsFeature,
     userPhotoUrl = :userPhotoUrl WHERE userPhotoId = :userPhotoId";
		$statement = $pdo->prepare($query);
		$parameters = ["userPhotoCaption" => $this->userPhotoCaption,"userPhotoIsFeature"=> $this->userPhotoIsFeature,
			"userPhotoUrl" => $this->userPhotoUrl];
		$statement->execute($parameters);
	}



	/**
	 * gets the photo by UserPhotoId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $userPhotoId author id to search for
	 * @return userPhoto|null photo found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getUserPhotoByUserPhotoId(\PDO $pdo, $userPhotoId) : ?userPhoto {
		// sanitize the tweetId before searching
		try {
			$userPhotoId = self::validateUuid($userPhotoId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = " SELECT userPhotoId, userPhotoSignId, userPhotoUserId, userPhotoCaption, 
		 userPhotoIsFeature, userPhotoUrl FROM userPhoto where userPhotoId = :userPhotoId";
		$statement = $pdo->prepare($query);

		// bind the userPhoto id to the place holder in the template
		$parameters = ["$userPhotoId" => $userPhotoId->getBytes()];
		$statement->execute($parameters);

		// grab the photo from mySQL
		try {
			$userPhotoId = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$userPhotoId = new userPhoto($row["userPhotoId"], $row["userPhotoSignId"], $row["userPhotoUserId"],
					$row["userPhotoCaption"], $row["UserPhotoIsFeature"], $row["userPhotoUrl"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($userPhotoId);
	}
	/**
	 **
	 * gets all photo
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of photo found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllUserPhoto(\PDO $pdo) : \SPLFixedArray {
		// create query template
		$query = "SELECT userPhotoId, userPhotoSignId, userPhotoUserId, userPhotoCaption,
       userPhotoIsFeature, userPhotoUrl FROM userPhoto";
		$statement = $pdo->prepare($query);
		$statement->execute();

		$userPhotos = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$userPhoto= new userPhoto ($row["userPhotoId"], $row["userPhotoSignId"], $row["userPhotoUserId"], $row["userPhotoCaption"], $row["userPhotoIsFeature"], $row["userPhotoUrl"]);
				$userPhotos[$userPhotos->key()] = $userPhoto;
				$userPhotos->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($userPhotos);
	}


	/**
	 * gets the photo by userPhotoIsFeature
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $userPhotoIsFeature to search for
	 * @return userPhoto|null  found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getuserPhotoByuserPhotoIsFeature(\PDO $pdo, $userPhotoIsFeature) : ?userPhoto {
		// sanitize the $userPhotoIsFeature before searching
		try {
			$userPhotoIsFeature = self::validateUuid($userPhotoIsFeature);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = " SELECT userPhotoId, userPhotoSignId, userPhotoUserId, userPhotoCaption, 
		 userPhotoIsFeature, userPhotoUrl FROM userPhoto where userPhotoIsFeature = :userPhotoIsFeature";
		$statement = $pdo->prepare($query);

		// bind the userPhoto feature to the place holder in the template
		$parameters = ["$userPhotoIsFeature" => $userPhotoIsFeature->getBytes()];
		$statement->execute($parameters);

		// grab the photo from mySQL
		try {
			$userPhotoIsFeature = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row === 1) {
				$userPhotoIsFeature = new userPhoto($row["userPhotoId"], $row["userPhotoSignId"], $row["userPhotoUserId"],
					$row["userPhotoCaption"], $row["UserPhotoIsFeature"], $row["userPhotoUrl"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($userPhotoIsFeature);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["userPhotoId"] = $this->userPhotoId->toString();
		unset($fields["UserPhotoCaption"]);
		unset($fields["UserPhotoUrl"]);
		return ($fields);
	}

}

?>
