<?php
/**
 * This is about userPhoto table.Here is declaration of all state variables
 */
namespace TheRouters\Capstone;

require_once("autoload.php");
require_once(dirname(__DIR__, 1) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class  UserPhoto implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * id for this userPhoto; this is the primary key
	 * @var Uuid $userPhotoID
	 **/
	private $userPhotoId;

	/**
	 * id of the sign table that link photos to each sign ; this is a foreign key
	 * @var Uuid $userPhotoSignId
	 **/
	private $userPhotoSignId;


	/**
	 * id of the user table that link user to photo; this is a foreign key
	 * @var Uuid $userPhotoUserId
	 **/
	private $userPhotoUserId;
	/**
	 * this attribute of userPhoto table that contains caption for user and description for
	 * photos to each sign ;
	 * @var Uuid $userPhotoCaption
	 **/

	private $userPhotoCaption;

	/**
	 * this attribute of userPhoto table that will be boolean value
	 * for each photos if it is featured or not;
	 * @var bool $userPhotoIsFeature
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
	 * @param bool $newUserPhotoIsFeature (1) contain data is featured or not.
	 * @param string $newUserPhotoUrl string containing actual  link  for photo
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newUserPhotoId, $newUserPhotoSignId, $newUserPhotoUserId, $newUserPhotoCaption, $newUserPhotoIsFeature, $newUserPhotoUrl = null) {
		try {
			$this->setUserPhotoSignId($newUserPhotoSignId);
			$this->setUserPhotoId($newUserPhotoId);
			$this->setUserPhotoUserId($newUserPhotoUserId);
			$this->setUserPhotoCaption($newUserPhotoCaption);
			$this->setUserPhotoIsFeature($newUserPhotoIsFeature);
			$this->setUserPhotoUrl($newUserPhotoUrl);
		} //determine what exception type was thrown
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
	public function getUserPhotoId(): Uuid {
		return ($this->userPhotoId);
	}

	/**
	 * mutator method for userPhoto id
	 *
	 * @param $newUserPhotoId
	 */
	public function setUserPhotoId($newUserPhotoId): void {
		try {
			$uuid = self::validateUuid($newUserPhotoId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the userPhoto id
		$this->userPhotoId = $uuid;
	}

	/**
	 * accessor method for userPhotoUserId this is foreign key
	 *
	 * @return Uuid value of UserPhotoUserId
	 **/
	public function getUserPhotoUserId(): Uuid {
		return ($this->userPhotoUserId);
	}

	/**
	 * mutator method for userPhotoUserId
	 *
	 * @param string | Uuid $newUserPhotoUserId new value of user  id
	 * @throws \RangeException if $newUserPhotoUserId is not positive
	 * @throws \TypeError if $newUserPhotoUserId is not an integer
	 **/
	public function setUserPhotoUserId($newUserPhotoUserId): void {
		try {
			$uuid = self::validateUuid($newUserPhotoUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the userPhotoUserId
		$this->userPhotoUserId = $uuid;
	}

	/**
	 * accessor method for userPhotoSignId this is foreign key
	 *
	 * @return Uuid value of userPhotoSignId
	 **/
	public function getUserPhotoSignId(): Uuid {
		return ($this->userPhotoSignId);
	}

	/**
	 * mutator method for userPhotoSignId
	 *
	 * @param string | Uuid $newUserPhotoSignId new value of user  id
	 * @throws \RangeException if $newUserPhotoSignId is not positive
	 * @throws \TypeError if $newUserPhotoSignId is not an integer
	 **/
	public function setUserPhotoSignId($newUserPhotoSignId): void {
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
	 * @return string value of userPhotoCaption content
	 **/
	public function getUserPhotoCaption(): string {
		return ($this->userPhotoCaption);
	}

	/**
	 * mutator method for userPhotoCaption content
	 *
	 * @param string $newUserPhotoCaption new value of userPhotoCaption content
	 * @throws \RangeException if $newUserPhotoCaption is > 255 characters
	 **/
	public function setUserPhotoCaption(?string $newUserPhotoCaption): void {
		//verifies data is null or not
		if($newUserPhotoCaption !== null) {
			//verify the content is secure
			$newUserPhotoCaption = trim($newUserPhotoCaption);
			$newUserPhotoCaption = filter_var($newUserPhotoCaption, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			//verify the content will fit in the database
			if(strlen($newUserPhotoCaption) > 255) {
				throw(new \RangeException("Caption should be less than 255 characters"));
			}
		}
		//store the content
		$this->userPhotoCaption = $newUserPhotoCaption;
	}

	/**
	 * accessor method for userPhotoIsFeature content
	 *
	 * @return bool value of userPhotoIsFeature content
	 **/
	public function getUserPhotoIsFeature(): bool {
		return ($this->userPhotoIsFeature);
	}

	/**
	 * mutator for $newUserPhotoIsFeature.
	 * @param bool $newUserPhotoIsFeature
	 * @throws /InvalidArgumentException if image is feature or not
	 */

	public function setUserPhotoIsFeature(int $newUserPhotoIsFeature): void {
		// verify the value will fit in the database.
		if($newUserPhotoIsFeature !== 0 && $newUserPhotoIsFeature !==1) {
			throw(new \InvalidArgumentException("Feature value must be 0 or 1"));
		}
		// store the image  content
		$this->userPhotoIsFeature = $newUserPhotoIsFeature;
	}

	/**
	 * accessor method for userPhotoUrl content
	 *
	 * @return string value of userPhotoUrl content
	 **/

	public function getUserPhotoUrl(): string {
		return ($this->userPhotoUrl);
	}

	/**
	 * mutator method
	 *
	 * @param string $newUserPhotoUrl new value of photo URL
	 * @throws \RangeException if $newUserPhotoUrl is > 255 characters
	 **/
	public function setUserPhotoUrl(string $newUserPhotoUrl): void {
		$newUserPhotoUrl = trim($newUserPhotoUrl);
		$newUserPhotoUrl = filter_var($newUserPhotoUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		// verify the  URL will fit in the database
		if(strlen($newUserPhotoUrl) > 255) {
			throw(new \RangeException("Image Url is too long"));
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
	public function insert(\PDO $pdo): void {
		// create query template
		$query = "INSERT INTO userPhoto(userPhotoId, userPhotoSignId, userPhotoUserId, userPhotoCaption, userPhotoIsFeature, userPhotoUrl) 
   VALUES(:userPhotoId, :userPhotoSignId, :userPhotoUserId,  :userPhotoCaption, :userPhotoIsFeature, :userPhotoUrl)";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["userPhotoId" => $this->userPhotoId->getBytes(), "userPhotoSignId" => $this->userPhotoSignId->getBytes(), "userPhotoUserId" => $this->userPhotoUserId->getBytes(),"userPhotoCaption" => $this->userPhotoCaption,
			"userPhotoIsFeature" => $this->userPhotoIsFeature, "userPhotoUrl" => $this->userPhotoUrl];
		$statement->execute($parameters);
	}

	/**
	 * deletes this userPhoto from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {

		// create query template
		$query = "DELETE FROM userPhoto WHERE userPhotoId = :userPhotoId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["userPhotoId" => $this->userPhotoId->getBytes()];
		$statement->execute($parameters);
	}


	/**
	 * gets the photo by UserPhotoId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $userPhotoId author id to search for
	 * @return userPhoto|null photo found or null if not found
	 * @throws \PDOException when mySQL related errors occur
**/
	public static function getUserPhotoByUserPhotoId(\PDO $pdo, $userPhotoId): ?userPhoto {
		// sanitize the UserPhotoId  before searching
		try {
			$userPhotoId = self::validateUuid($userPhotoId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template note: do we need userphotoid here or not
		$query = "SELECT userPhotoId, userPhotoSignId, userPhotoUserId,  userPhotoCaption, userPhotoIsFeature, userPhotoUrl FROM  userPhoto WHERE userPhotoId = :userPhotoId";
		$statement = $pdo->prepare($query);

		// bind the userPhotoId to the place holder in the template
		$parameters = ["userPhotoId" => $userPhotoId->getBytes()];
		$statement->execute($parameters);

		// grab the photo from mySQL
		try {
			$userPhotoId = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$userPhotoId = new userPhoto($row["userPhotoId"],  $row["userPhotoSignId"],$row["userPhotoUserId"],
					$row["userPhotoCaption"], $row["userPhotoIsFeature"], $row["userPhotoUrl"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($userPhotoId);
	}


	/**
	 **
	 * gets all photo
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of photo found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 **/
	public static function getAllUserPhotos(\PDO $pdo): \SPLFixedArray {
		// create query template
		$query = "SELECT userPhotoId, userPhotoSignId, userPhotoUserId,  userPhotoCaption,userPhotoIsFeature, userPhotoUrl FROM userPhoto";
		$statement = $pdo->prepare($query);
		$statement->execute();

		$userPhotos = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$userPhoto = new userPhoto ($row["userPhotoId"],  $row["userPhotoSignId"], $row["userPhotoUserId"], $row["userPhotoCaption"], $row["userPhotoIsFeature"], $row["userPhotoUrl"]);
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
	public static function getUserPhotoByUserPhotoIsFeature(\PDO $pdo): \SPLFixedArray{

		// create query template
		$query = " SELECT userPhotoId,  userPhotoSignId, userPhotoUserId, userPhotoCaption, 
		 userPhotoIsFeature, userPhotoUrl FROM userPhoto where userPhotoIsFeature = 1";
		$statement = $pdo->prepare($query);
		// bind the userPhoto feature to the place holder in the template
		$statement->execute();

		// grab the photo from mySQL

			$userPhotos = new \SplFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$userPhoto = new UserPhoto($row["userPhotoId"],  $row["userPhotoSignId"],$row["userPhotoUserId"], $row["userPhotoCaption"], $row["userPhotoIsFeature"], $row["userPhotoUrl"]);
				$userPhotos[$userPhotos->key()] = $userPhoto;
				$userPhotos->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($userPhotos);
	}

	/**
	 * gets the Photo by Sign id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $userPhotoSignId photo with sign id to search by
	 * @return \SplFixedArray SplFixedArray of photo found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserPhotoByUserPhotoSignId(\PDO $pdo, string $userPhotoSignId): \SPLFixedArray {
		try {
			$userPhotoSignId = self::validateUuid($userPhotoSignId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT userPhotoId, userPhotoUserId,  userPhotoCaption, userPhotoSignId, userPhotoIsFeature ,userPhotoUrl
		FROM userPhoto WHERE userPhotoSignId = :userPhotoSignId";
		$statement = $pdo->prepare($query);
		// bind the PHOTO SIGN id to the place holder in the template
		$parameters = ["userPhotoSignId" => $userPhotoSignId->getBytes()];
		$statement->execute($parameters);
		// build an array of photo
		$userPhotos = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$userPhoto = new UserPhoto($row["userPhotoId"],  $row["userPhotoSignId"], $row["userPhotoUserId"],
					$row["userPhotoCaption"], $row["userPhotoIsFeature"], $row["userPhotoUrl"]);
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
	 * gets the Photo by user id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $userPhotoUserId
	 * @return \SplFixedArray SplFixedArray of photo found
	 */


	public static function getUserPhotoByUserPhotoUserId(\PDO $pdo, string $userPhotoUserId): \SPLFixedArray {
		try {
			$userPhotoUserId = self::validateUuid($userPhotoUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT userPhotoId,  userPhotoSignId, userPhotoUserId, userPhotoCaption, userPhotoIsFeature ,userPhotoUrl
		FROM userPhoto WHERE userPhotoUserId = :userPhotoUserId";
		$statement = $pdo->prepare($query);
		// bind the photo user id to the place holder in the template
		$parameters = ["userPhotoUserId" => $userPhotoUserId->getBytes()];
		$statement->execute($parameters);

		// build an array of photos
		$userPhotos = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$userPhoto = new UserPhoto($row["userPhotoId"], $row["userPhotoSignId"], $row["userPhotoUserId"],
					$row["userPhotoCaption"], $row["userPhotoIsFeature"], $row["userPhotoUrl"]);
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
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["userPhotoId"] = $this->userPhotoId->toString();
		$fields["userPhotoSignId"] = $this->userPhotoSignId->toString();
		$fields["userPhotoUserId"] = $this->userPhotoUserId->toString();

		return ($fields);
	}

}

?>
