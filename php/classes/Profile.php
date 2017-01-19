<?php

/**
 * Profile class
 *
 * This Profile is a small sample of the total data stored by Product Hunt
 *
 * @author Mason Crane <cmd-space.com>
 * @version 1.0.0
 **/
class Profile {
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
	 * accessor method for profileAvatarImage
	 *
	 * @return string value of profile avatar image
	 **/
	public function getProfileAvatarImage() {
		return($this->profileAvatarImage);
	}

	/**
	 * mutator method for profileAvatarImage
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
}