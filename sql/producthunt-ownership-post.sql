DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS profile;

-- the CREATE TABLE function is a function that takes tons of arguments to layout the table's schema
CREATE TABLE profile (
	-- this creates the attribute for the primary key
	-- auto_increment tells mySQL to number them {1, 2, 3, ...}
	-- not null means the attribute is required!
	profileId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	profileAvatarImage VARCHAR,
	profileCreatedTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	profileEmail VARCHAR(128) NOT NULL,
	profileFirstName VARCHAR(32) NOT NULL,
	profileLastName VARCHAR(32) NOT NULL,
	-- to make something optional, exclude the not null
	-- to make sure duplicate data cannot exist, create a unique index
	UNIQUE(profileEmail),
	-- this officiates the primary key for the entity
	PRIMARY KEY(profileId)
);

-- create the tweet entity
CREATE TABLE post (
	-- this is for yet another primary key...
	postId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	-- this is for a foreign key; auto_increment is omitted by design
	postProfileId INT UNSIGNED NOT NULL,
	postCreatedTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	-- notice dates don't need a size parameter
	postGalleryImage VARCHAR,
	postProductName VARCHAR(140),
	postThumbnailImage VARCHAR,
	postUrl VARCHAR,
	-- this creates an index before making a foreign key
	INDEX(postProfileId),
	-- this creates the actual foreign key relation
	FOREIGN KEY(postProfileId) REFERENCES profile(profileId),
	-- and finally create the primary key
	PRIMARY KEY(postId)
);