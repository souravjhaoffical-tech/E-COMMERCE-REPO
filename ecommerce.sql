
USE K;

CREATE TABLE  eproduct (
    id INT  AUTO_INCREMENT PRIMARY KEY, 
    p_brand VARCHAR (100),
    p_name VARCHAR (100),
    p_price INT (100),
    image  VARCHAR (250)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    p_name VARCHAR(100),
    p_price INT, 
    payment_method VARCHAR(50),
    STATUS VARCHAR (50)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

INSERT INTO users (email,password) VALUES('souravjha700377@gmail.com','1234');




