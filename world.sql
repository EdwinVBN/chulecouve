DROP DATABASE IF EXISTS world;
CREATE DATABASE world;

CREATE TABLE world.continent (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	description VARCHAR(255),

	PRIMARY KEY (id)
);

CREATE TABLE world.user (
	name VARCHAR(20),
	person_id INT UNSIGNED UNIQUE,

	PRIMARY KEY (name),
	FOREIGN KEY (person_id) REFERENCES world.continent(id)
);

INSERT INTO world.continent (name, description) VALUES
	('Africa', 'A continent where the sunsets are as breathtaking as its rich culture, and the wildlife roams as freely as the spirit of adventure'),
	('Antarctica', 'Earths final frontier, where the ice sparkles like diamonds and the silence speaks volumes about the beauty of natures calm'),
	('Asia', 'A mosaic of ancient traditions and cutting-edge innovation, where every corner offers a new lesson in history and a glimpse into the future'),
	('Europe', 'A continent where every street tells a story, blending centuries-old architecture with the pulse of modern life'),
	('North America', 'A land of diverse landscapes and dreams, where innovation meets the great outdoors, and cultures blend seamlessly'),
	('Oceania', 'A rugged and resilient land, where the wildlife is as unique as the spirit of mateship that defines its people'),
	('South America', 'A continent pulsing with the rhythm of the rainforest, where ancient ruins and vibrant cities coexist under the southern sky');

INSERT INTO world.user (name, person_id) VALUES
    ('Amara', 1),
	('Zihu', 2),
	('Katsu', 3),
	('Jean', 4),
	('Jake', 5),
	('Matilda', 6),
	('Carlos', 7)