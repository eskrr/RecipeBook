CREATE TABLE User (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	description VARCHAR(200) NOT NULL,
	email VARCHAR(30) NOT NULL UNIQUE,
	password VARCHAR(64) NOT NULL
);

CREATE TABLE Recipe (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	author_id INT(6) NOT NULL REFERENCES User(id),
	name VARCHAR(30) NOT NULL,
	description VARCHAR(500) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Ingredient (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	recipe_id INT(6) NOT NULL REFERENCES Recipe(id),
	name VARCHAR(30) NOT NULL,
	quantity VARCHAR(30) NOT NULL,
	unit VARCHAR(30) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Step (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	recipe_id INT(6) NOT NULL REFERENCES Recipe(id),
	description VARCHAR(1000) NOT NULL,
	image_url VARCHAR(200) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
