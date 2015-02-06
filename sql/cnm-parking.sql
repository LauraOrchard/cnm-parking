-- table drops
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS adminProfile;
DROP TABLE IF EXISTS parkingPass;
DROP TABLE IF EXISTS parkingSpot;
DROP TABLE IF EXISTS location;
DROP TABLE IF EXISTS vehicle;
DROP TABLE IF EXISTS visitor;

-- arbitrary use of character length as 128 for varchar.
CREATE TABLE admin (
	adminId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	activation VARCHAR(32),
	adminEmail VARCHAR(128) NOT NULL,
	passHash VARCHAR(128),
	salt VARCHAR(64),
	UNIQUE(adminEmail),
	PRIMARY KEY(adminId)
);

CREATE TABLE adminProfile (
	adminProfileId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	adminId INT UNSIGNED NOT NULL,
	adminFirstName VARCHAR(128) NOT NULL,
	adminLastName VARCHAR(128) NOT NULL,
	INDEX(adminId),
	FOREIGN KEY(adminId) REFERENCES admin(adminId),
	PRIMARY KEY(adminProfileId)
);

CREATE TABLE visitor (
	visitorId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	visitorEmail VARCHAR(128) NOT NULL,
	visitorFirstName VARCHAR(128) NOT NULL,
	visitorLastName VARCHAR(128) NOT NULL,
-- for 24 digit phone number
	visitorPhone VARCHAR(24) NOT NULL,
	UNIQUE(visitorEmail),
	PRIMARY KEY(visitorId)
);

CREATE TABLE vehicle (
	vehicleId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	visitorId INT UNSIGNED NOT NULL,
	vehicleColor VARCHAR(128) NOT NULL,
	vehicleMake VARCHAR(128) NOT NULL,
	vehicleModel VARCHAR(128) NOT NULL,
	vehiclePlateNumber VARCHAR(128) NOT NULL,
	vehiclePlateState VARCHAR(2),
	vehicleYear SMALLINT(4) NOT NULL,
	INDEX (visitorId),
	FOREIGN KEY(visitorId) REFERENCES visitor(visitorId),
	PRIMARY KEY(vehicleId)
);

CREATE TABLE location (
	locationId INT UNSIGNED AUTO_INCREMENT NOT NULL,
-- using pure decimal representation for gps coordinates
	latitude DECIMAL(8,6) NOT NULL,
	locationDescription VARCHAR(128) NOT NULL,
	locationNote VARCHAR(128),
-- using pure decimal representation for gps coordinates
	longitude DECIMAL(9,6) NOT NULL,
	PRIMARY KEY(locationId)
);

CREATE TABLE parkingSpot (
	parkingSpotId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	locationId INT UNSIGNED NOT NULL,
	placardNumber VARCHAR(16) NOT NULL,
	UNIQUE (locationId, placardNumber),
	INDEX (locationId),
	FOREIGN KEY(locationId) REFERENCES location(locationId),
	PRIMARY KEY(parkingSpotId)
);

CREATE TABLE parkingPass (
	parkingPassId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	adminId INT UNSIGNED NOT NULL,
	parkingSpotId INT UNSIGNED NOT NULL,
	vehicleId INT UNSIGNED NOT NULL,
	endDateTime DATETIME NOT NULL,
	issuedDateTime DATETIME NOT NULL,
	startDateTime DATETIME NOT NULL,
	uuId CHAR(36) NOT NULL,
	INDEX(adminId),
	INDEX(parkingSpotId),
	INDEX (vehicleId),
	UNIQUE (uuId),
	FOREIGN KEY(adminId) REFERENCES admin(adminId),
	FOREIGN KEY(parkingSpotId) REFERENCES parkingSpot(parkingSpotId),
	FOREIGN KEY(vehicleId) REFERENCES vehicle(vehicleId),
	PRIMARY KEY (parkingPassId)
);
