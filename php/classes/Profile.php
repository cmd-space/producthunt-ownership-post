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

	}
}