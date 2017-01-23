<?php

/**
 * Profile class
 *
 * This Profile is a small sample of the total data stored by Product Hunt
 *
 * @author Mason Crane <cmd-space.com>
 * @version 1.0.0
 **/
class Profile implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for this profile
	 * @var int $profileId
	 */
	private $profileId;
	/**
	 * avatar image for this profile
	 * @var string $profileAvatarImage
	 **/
	private $profileAvatarImage;
	/**
	 * date and time this profile was created
	 * @var $profileCreatedTimestamp
	 **/
	private $profileCreatedTimestamp;
	/**
	 * email for this profile
	 * @var $profileEmail
	 **/
	private $profileEmail;
	/**
	 * first name of this profile user
	 * @var $profileFirstName
	 **/
	private $profileFirstName;
	/**
	 * last name of this profile user
	 * @var $profileLastName
	 **/
	private $profileLastName;

	/**
	 * constructor for this profile
	 *
	 * @param int|null $newProfileId id of this profile or null if a new profile
	 * @param string $newProfileAvatarImage string containing profile avatar image
	 * @param \DateTime|string|null $newProfileCreatedTimestamp date and time profile was created or null if set to current date and time
	 * @param string $newProfileEmail email of this profile
	 * @param string $newProfileFirstName first name of this profile
	 * @param string $newProfileLastName last name of this profile
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (i.e. strings too long, or negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newProfileId = null, string $newProfileAvatarImage, DateTime $newProfileCreatedTimestamp = null, string $newProfileEmail, string $newProfileFirstName, string $newProfileLastName) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileAvatarImage($newProfileAvatarImage);
			$this->setProfileCreatedTimestamp($newProfileCreatedTimestamp);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileFirstName($newProfileFirstName);
			$this->setProfileLastName($newProfileLastName);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for profile id
	 *
	 * @return int|null value of profile id
	 **/
	public function getProfileId() {
		return($this->profileId);
	}

	/**
	 * mutator method for profile id
	 *
	 * @param int|null $newProfileId new value of profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not an integer
	 **/
	public function setProfileId(int $newProfileId = null) {
		// base case: if the profile id is null, this is a new profile without a mySQL assigned id (yet)
		if($newProfileId === null) {
			$this->profileId = null;
			return;
		}

		// verify the profile id is positive
		if($newProfileId <= 0) {
			throw(new \RangeException("profile id is not positive"));
		}

		// convert and store the profile id
		$this->profileId = $newProfileId;
	}

	/**
	 * accessor method for profile avatar image
	 *
	 * @return string value of profile avatar image
	 **/
	public function getProfileAvatarImage() {
		return($this->profileAvatarImage);
	}

	/**
	 * mutator method for profile avatar image
	 *
	 * @param string $newProfileAvatarImage new value of profile avatar image
	 * @throws \InvalidArgumentException if $newProfileAvatarImage is insecure or not expected
	 * @throws \TypeError if $newProfileAvatarImage is not a string
	 **/
	public function setProfileAvatarImage(string $newProfileAvatarImage) {
		// verify the profile avatar image is secure
		$newProfileAvatarImage = trim($newProfileAvatarImage);
		$newProfileAvatarImage = filter_var($newProfileAvatarImage, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileAvatarImage) === true) {
			throw(new \InvalidArgumentException("avatar image is empty or insecure"));
		}

		// store the profile avatar image
		$this->profileAvatarImage = $newProfileAvatarImage;
	}

	/**
	 * accessor method for profile created timestamp
	 *
	 * @return \DateTime value of profile created timestamp
	 **/
	public function getProfileCreatedTimestamp() {
		return($this->profileCreatedTimestamp);
	}

	/**
	 * mutator method for profile created timestamp
	 *
	 * @param \DateTime|string|null $newProfileCreatedTimestamp profile created timestamp as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newProfileCreatedTimestamp is not a valid object or string
	 * @throws \RangeException if $newProfileCreatedTimestamp is a date that does not exist
	 **/
	public function setProfileCreatedTimestamp($newProfileCreatedTimestamp = null) {
		if($newProfileCreatedTimestamp === null) {
			$this->profileCreatedTimestamp = new \DateTime();
			return;
		}

		// store the profile created timestamp
		try {
			$newProfileCreatedTimestamp = self::validateDateTime($newProfileCreatedTimestamp);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->profileCreatedTimestamp = $newProfileCreatedTimestamp;
	}

	/**
	 * accessor method for profile email
	 *
	 * @return string value of profile email
	 **/
	public function getProfileEmail() {
		return($this->profileEmail);
	}

	/**
	 * mutator method for profile email
	 *
	 * @param string $newProfileEmail new value of profile email
	 * @throws \InvalidArgumentException if $newProfileEmail is not secure or unexpected
	 * @throws \RangeException if $newProfileEmail > 128 characters
	 * @throws \TypeError if $newProfileEmail is not a string
	 **/
	public function setProfileEmail(string $newProfileEmail) {
		// verify that email content is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("email content is empty or insecure"));
		}

		// verify the email content will fit in the database
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("email content too large"));
		}

		// store the email content
		$this->profileEmail = $newProfileEmail;
	}

	/**
	 * accessor method for profile first name
	 *
	 * @return string value of profile first name
	 **/
	public function getProfileFirstName() {
		return($this->profileFirstName);
	}

	/**
	 * mutator method for profile first name
	 *
	 * @param string $newProfileFirstName new value of profile first name
	 * @throws \InvalidArgumentException if $newProfileFirstName is not secure or unexpected
	 * @throws \RangeException if $newProfileFirstName is > 32 characters
	 * @throws \TypeError if $newProfileFirstName is not a string
	 **/
	public function setProfileFirstName(string $newProfileFirstName) {
		// verify the profile first name is secure
		$newProfileFirstName = trim($newProfileFirstName);
		$newProfileFirstName = filter_var($newProfileFirstName, FILTER_SANITIZE_STRING);
		if(empty($newProfileFirstName) === true) {
			throw(new \InvalidArgumentException("profile first name is empty or insecure"));
		}

		// verify the profile first name content will fit in the database
		if(strlen($newProfileFirstName) > 32) {
			throw(new \RangeException("profile first name too large"));
		}

		// store the profile first name content
		$this->profileFirstName = $newProfileFirstName;
	}

	/**
	 * accessor method for profile last name
	 *
	 * @return string value of profile last name
	 **/
	public function getProfileLastName() {
		return($this->profileLastName);
	}

	/**
	 * mutator method for profile last name
	 *
	 * @param string $newProfileLastName new value for profile last name
	 * @throws \InvalidArgumentException if $newProfileLastName is not secure or is unexpected
	 * @throws \RangeException if $newProfileLastName is > 32 characters
	 * @throws \TypeError if $newProfileLastName is not a string
	 **/
	public function setProfileLastName(string $newProfileLastName) {
		// verify the profile last name content is secure
		$newProfileLastName = trim($newProfileLastName);
		$newProfileLastName = filter_var($newProfileLastName, FILTER_SANITIZE_STRING);
		if(empty($newProfileLastName) === true) {
			throw(new \InvalidArgumentException("profile last name content is empty or insecure"));
		}

		// verify the profile last name content will fit in database
		if(strlen($newProfileLastName) > 32) {
			throw(new \RangeException("profile last name content too large"));
		}

		// store thew profile last name
		$this->profileLastName = $newProfileLastName;
	}

	/**
	 * inserts this profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the ProfileId is null (i.e., don't insert a profile that already exists)
		if($this->profileId !== null) {
			throw(new \PDOException("not a new profile"));
		}

		// create query template
		$query = "INSERT INTO profile(profileAvatarImage, profileCreatedTimestamp, profileEmail, profileFirstName, profileLastName) VALUES(:profileAvatarImage, :profileCreatedTimeStamp, :profileEmail, :profileFirstName, :profileLastName)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->profileCreatedTimestamp->format("Y-m-d H:i:s");
		$parameters = ["profileAvatarImage" => $this->profileAvatarImage, "profileCreatedTimestamp" => $this->$formattedDate, "profileEmail" => $this->profileEmail, "profileFirstName" => $this->profileFirstName, "profileLastName" => $this->profileLastName];
		$statement->execute($parameters);

		// update the null profileId with what mySQL just gave us
		$this->profileId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySSQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce the profileId is not null (i.e., don't delete a profile that hasn't been inserted)
		if($this->profileId === null) {
			throw(new \PDOException("unable to delete a profile that does not exist"));
		}

		// create query template
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["profileId" => $this->profileId];
		$statement->execute($parameters);
	}

	/**
	 * updates this profile in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforce the profileId is not null (i.e., don't update a profile that hasn't been inserted)
		if($this->profileId === null) {
			throw(new \PDOException("unable to update a profile that does not exist"));
		}

		// create query template
		$query = "UPDATE profile SET profileAvatarImage = :profileAvatarImage, profileCreatedTimestamp = :profileCreatedTimeStamp, profileEmail = :profileEmail, profileFirstName = :profileFirstName, profileLastName = :profileLastName WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->profileCreatedTimestamp->format("Y-m-d H:i:s");
		$parameters = ["profileAvatarImage" => $this->profileAvatarImage, "profileCreatedTimestamp" => $this->profileCreatedTimestamp, "profileEmail" => $this->profileEmail, "profileFirstName" => $this->profileFirstName, "profileLastName" => $this->profileLastName, "profileId" => $this->profileId];
		$statement->execute($parameters);
	}

	/**
	 * gets the profile by email
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $profileEmail profile email to search for
	 * @return string $profileEmail profile email found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByProfileEmail(\PDO $pdo, string $profileEmail) {
		// sanitize the description before searching
		$profileEmail = trim($profileEmail);
		$profileEmail = filter_var($profileEmail, FILTER_SANITIZE_EMAIL);
		if(empty($profileEmail) === true) {
			throw(new \PDOException("profile email is invalid"));
		}

		// create query template
		$query = "SELECT profileId, profileAvatarImage, profileCreatedTimestamp, profileEmail, profileFirstName, profileLastName FROM profile WHERE profileEmail LIKE :profileEmail";
		$statement = $pdo->prepare($query);

		// bind the profile email to the place holder in the template
		$profileEmail = "%$profileEmail%";
		$parameters = ["profileEmail" => $profileEmail];
		$statement->execute($parameters);

		//build an array of profile(s)
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profile = new Profile($row["profileId"], $row["profileAvatarImage"], $row["profileCreatedTimestamp"], $row["profileEmail"], $row["profileFirstName"], $row["profileLastName"]);
				$profiles[$profiles->key()] = $profile;
				$profile->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}

	/**
	 * gets the profile by profileId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $profileId profile id to search for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByProfileId(\PDO $pdo, int $profileId) {
		//sanitize the profileId before searching
		if($profileId <= 0) {
			throw(new \PDOException("profile id is not positive"));
		}

		//create query template
		$query = "SELECT profileId, profileAvatarImage, profileCreatedTimestamp, profileEmail, profileFirstName, profileLastName FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		//bind the profile id to the placeholder in the template
		$parameters = ["profileId" => $profileId];
		$statement->execute($parameters);

		//grab the profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode( \PDO::FETCH_ASSOC );
			$row = $statement->fetch();
			if ( $row !== false ) {
				$profile = new Profile( $row["profileId"], $row["profileAvatarImage"], $row["profileCreatedTimestamp"], $row["profileEmail"], $row["profileFirstName"], $row["profileLastName"] );
			}
		} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		return($profile);
		}

	/**
	 * gets the profile by profile first name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $profileFirstName profile first name to search by
	 * @return \SplFixedArray SplFixedArray of profile(s) found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByProfileFirstName(\PDO $pdo, string $profileFirstName) {
		//sanitize the name before searching
		$profileFirstName = trim($profileFirstName);
		$profileFirstName = filter_var($profileFirstName, FILTER_SANITIZE_STRING);
		if(empty($profileFirstName) === true) {
			throw(new \PDOException("profile first name is invalid"));
		}

		//create query template
		$query = "SELECT profileId, profileAvatarImage, profileCreatedTimestamp, profileEmail, profileFirstName, profileLastName FROM profile WHERE profileFirstName LIKE :profileFirstName";
		$statement = $pdo->prepare($query);

		//bind the profile first name to the placeholder in the template
		$profileFirstName = "%$profileFirstName%";
		$parameters = ["profileFirstName" => $profileFirstName];
		$statement->execute($parameters);

		//build an array of profile(s)
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profile = new Profile($row["profileId"], $row["profileAvatarImage"], $row["profileCreatedTimestamp"], $row["profileEmail"], $row["profileFirstName"], $row["profileLastName"]);
				$profiles[$profiles->key()] = $profile;
				$profiles->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["profileCreatedTimestamp"] = $this->profileCreatedTimestamp->getTimestamp() * 1000;
		return $fields;
	}
}