use bugtrack;

CREATE TABLE changelog (
  id int AUTO_INCREMENT PRIMARY KEY,
  productId int,
  version varchar(30),
  filepath text,
  FOREIGN KEY (productId) REFERENCES product(id)
);  

CREATE TABLE clform (
  id int AUTO_INCREMENT PRIMARY KEY,
  productId int,
  code text,
  FOREIGN KEY (productId) REFERENCES product(id)
);  

CREATE TABLE dictionary (
  id int AUTO_INCREMENT PRIMARY KEY,
  productId int,
  clformId int,
  dictionary text,
  FOREIGN KEY (productId) REFERENCES product(id),
  FOREIGN KEY (clformId) REFERENCES clform(id)
);  
