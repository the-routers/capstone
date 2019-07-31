<?php
/**
 * This is about userPhoto table.Here is declaration of all state variables
 */
namespace Rhariyani\capstone;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class  userPhoto{
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
	 * @var Uuid $userPhotoIsFeature
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
* @param string|Uuid $newuserPhotoId id of this UserPhoto
* @param string|Uuid $newuserPhotoUserId id of the user table
 * @param string|Uuid $newuserPhotoSignId id of the sign table
 * @param string $newuserPhotoCaption string containing actual  data for photo
 * @param boolean $newuserPhotoIsFeature (1) contain data is featured or not.
 * @param string $newuuserPhotoUrl string containing actual  link  for photo
 * @throws \InvalidArgumentException if data types are not valid
* @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
* @throws \TypeError if data types violate type hints
* @throws \Exception if some other exception occurs
* @Documentation https://php.net/manual/en/language.oop5.decon.php
**/
	public function __construct($newUserPhotoId, $newUserPhotoUserId, $newUserPhotoSignId, $newUserPhotoCaption, $newUserPhotoIsFeature, $newUserPhotoUrl= null) {
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

}

?>
