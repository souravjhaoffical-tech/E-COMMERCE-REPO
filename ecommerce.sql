
USE ecommerce_db;

CREATE TABLE  eproduct (
    id INT  AUTO_INCREMENT PRIMARY KEY, 
    p_brand VARCHAR (100),
    p_name VARCHAR (100),
    p_price VARCHAR (100)
);

CREATE TABLE  users  (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    email VARCHAR (100),
    password VARCHAR (100)
);

INSERT INTO users (email,password) VALUES('souravjha700@gmail.com','1234');

