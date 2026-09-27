
USE c;

CREATE TABLE  eproduct (
    id INT  AUTO_INCREMENT PRIMARY KEY, 
    p_brand VARCHAR (100),
    p_name VARCHAR (100),
    p_price VARCHAR (100),
    image  VARCHAR (250)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
);

INSERT INTO users (name,email,password,role) VALUES('Sourav Jha','souravjha700377@gmail.com','1234','admin');

ALTER TABLE users 
ADD role VARCHAR(20) DEFAULT 'user';
UPDATE users
SET role = 'admin'
WHERE email = 'souravjha700377@gmail.com';
