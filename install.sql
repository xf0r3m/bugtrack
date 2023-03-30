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

CREATE TABLE product (
  id int AUTO_INCREMENT PRIMARY KEY,
  name varchar(30),
  author varchar(60),
  description text
);

CREATE TABLE component (
  id int AUTO_INCREMENT PRIMARY KEY,
  productId int,
  name varchar(30),
  author varchar(60),
  description text,
  FOREIGN KEY (productId) REFERENCES product(id)
);

CREATE TABLE site (
  id int AUTO_INCREMENT PRIMARY KEY,
  slogan text
);

CREATE TABLE bug (
  id int AUTO_INCREMENT PRIMARY KEY,
  productId int,
  componentId int,
  typeof varchar(60),
  subject varchar(255),
  description text,
  state int,
  FOREIGN KEY (productId) REFERENCES product(id),
  FOREIGN KEY (componentId) REFERENCES component(id)
);

INSERT INTO user (username, passwd_hash, role) VALUES ('xf0r3m', "$2y$10$MlbeMeXc3SCoxNftEiyM9OVcuaQcucHbizX4aI0QOZguBCUkZRO0q", 'admin');
INSERT INTO site (slogan) VALUES ('Hello, World!');
