DROP DATABASE IF EXISTS world;
CREATE DATABASE world;

CREATE TABLE world.continent (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	description VARCHAR(255),
	current_location VARCHAR(20),
	north VARCHAR(20),
	east VARCHAR(20),
	south VARCHAR(20),
	west VARCHAR(20),

	PRIMARY KEY (id)
);

CREATE TABLE world.user (
	name VARCHAR(20),
	person_id INT UNSIGNED UNIQUE,
	last_played VARCHAR(20),

	PRIMARY KEY (name),
	FOREIGN KEY (person_id) REFERENCES world.continent(id)
);

CREATE TABLE world.countries (
	id INT UNSIGNED UNIQUE AUTO_INCREMENT,
	country_name VARCHAR(100),
	continent_id INT,
	description VARCHAR(255),

	PRIMARY KEY (id),
	FOREIGN KEY (continent_id) REFERENCES world.continent(id)
);

INSERT INTO world.continent (name, description, current_location, north, east, south, west) VALUES
	('Africa', 'A continent where the sunsets are as breathtaking as its rich culture, and the wildlife roams as freely as the spirit of adventure', 'true', 'Europe', 'Oceania', 'Antarctica', 'South America'),
	('Antarctica', 'Earths final frontier, where the ice sparkles like diamonds and the silence speaks volumes about the beauty of natures calm', 'false', NULL, NULL, NULL, NULL),
	('Asia', 'A mosaic of ancient traditions and cutting-edge innovation, where every corner offers a new lesson in history and a glimpse into the future', 'false', 'Arctic', 'North America', 'Oceania', 'Europe'),
	('Europe', 'A continent where every street tells a story, blending centuries-old architecture with the pulse of modern life', 'false', 'Arctic', 'Asia', 'Africa', 'North America'),
	('North America', 'A land of diverse landscapes and dreams, where innovation meets the great outdoors, and cultures blend seamlessly', 'false', 'Arctic', 'Europe', 'South America', 'Asia'),
	('Oceania', 'A rugged and resilient land, where the wildlife is as unique as the spirit of mateship that defines its people', 'false', 'Asia', 'South America', 'Antarctica', 'Africa'),
	('South America', 'A continent pulsing with the rhythm of the rainforest, where ancient ruins and vibrant cities coexist under the southern sky', 'false', 'North America', 'Africa', 'Antarctica', 'Oceania'),
	('Arctic', 'A vast icy wilderness where polar bears roam and the Northern Lights dance across the sky', 'false', NULL, NULL, NULL, NULL);

INSERT INTO world.user (name, person_id, last_played) VALUES
    ('Amara', 1, 'true'),
	('Zihu', 2, 'false'),
	('Katsu', 3, 'false'),
	('Jean', 4, 'false'),
	('Jake', 5, 'false'),
	('Matilda', 6, 'false'),
	('Carlos', 7, 'false'),
	('Emile', 8, 'false');