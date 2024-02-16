USE honeywords;

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    honeywords VARCHAR(1000) NOT NULL,
    PRIMARY KEY (id)
);
