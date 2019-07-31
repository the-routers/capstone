ALTER DATABASE signson66 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS userPhoto;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS sign;

CREATE TABLE sign(
   signId BINARY(16) NOT NULL,
   signDescription VARCHAR(255) NOT NULL,
   signLat DECIMAL(9,6) NOT NULL,
   signLong DECIMAL(9,6) NOT NULL,
   signName VARCHAR(75) NOT NULL,
   signType VARCHAR(15) NOT NULL,
	PRIMARY KEY(signId)
);

CREATE TABLE user(
	userId BINARY(16) NOT NULL,
	userActivationToken CHAR(32) NOT NULL,
	userEmail VARCHAR(128) NOT NULL,
	userName VARCHAR(50) NOT NULL,
	userPassword VARCHAR(50) NOT NULL,
	UNIQUE (userEmail),
	UNIQUE (userName),
	PRIMARY KEY(userId)
);

CREATE TABLE userPhoto(
	userPhotoId BINARY(16) NOT NULL,
	userPhotoUserId BINARY(16) NOT NULL,
	userPhotoSignId BINARY(16) NOT NULL,
	userPhotoCaption VARCHAR(255),
	userPhotoIsFeature TINYINT(1) NOT NULL,
	userPhotoUrl VARCHAR(255) NOT NULL,
	FOREIGN KEY (userPhotoSignID) REFERENCES sign(signId),
	FOREIGN KEY (userPhotoUserId) REFERENCES user(userId),
	PRIMARY KEY(userPhotoId)
);
