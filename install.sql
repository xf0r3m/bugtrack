CREATE USER 'bugtrack'@'localhost' IDENTIFIED BY '1234Test1234#@';
CREATE DATABASE bugtrack;
GRANT ALL ON bugtrack.* TO 'bugtrack'@'localhost';

use bugtrack;

CREATE TABLE user (
	id int AUTO_INCREMENT PRIMARY KEY,
	username varchar(30),
	passwd_hash text,
	role varchar(30)
);

INSERT INTO user (username, passwd_hash, role) VALUES ('xf0r3m', "$2y$10$MlbeMeXc3SCoxNftEiyM9OVcuaQcucHbizX4aI0QOZguBCUkZRO0q", 'admin');
