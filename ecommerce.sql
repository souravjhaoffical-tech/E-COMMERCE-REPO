
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
    razorpay_order_id VARCHAR  (100),
    razorpay_payment_id varchar(100),
    STATUS VARCHAR (50)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(20) NOT NULL DEFAULT 'user');

INSERT INTO users (name, email, password, role)
VALUES ('Sourav', 'souravjha700377@gmail.com', '1234', 'admin');

UPDATE users
SET role = 'admin'
WHERE email = 'souravjha700377@gmail.com'




