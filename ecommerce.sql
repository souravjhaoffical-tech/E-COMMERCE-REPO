
-- ==========================================
-- SHOPVIBE E-COMMERCE DATABASE
-- ==========================================

CREATE DATABASE IF NOT EXISTS k;
USE k;


-- ==========================================
-- 1. EPRODUCT TABLE
-- ==========================================

CREATE TABLE IF NOT EXISTS eproduct (
    id INT AUTO_INCREMENT PRIMARY KEY,
    p_brand VARCHAR(100) DEFAULT NULL,
    p_name VARCHAR(100) DEFAULT NULL,
    p_price INT DEFAULT NULL,
    image VARCHAR(250) DEFAULT NULL,
    stock_quantity INT NOT NULL DEFAULT 0,
    category VARCHAR(100) NOT NULL DEFAULT 'Other'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ==========================================
-- 2. ORDERS TABLE
-- ==========================================

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT DEFAULT NULL,
    product_id INT DEFAULT NULL,

    p_name VARCHAR(100) DEFAULT NULL,
    p_price INT DEFAULT NULL,
    quantity INT NOT NULL DEFAULT 1,

    payment_method VARCHAR(50) DEFAULT NULL,

    razorpay_order_id VARCHAR(100) DEFAULT NULL,
    razorpay_payment_id VARCHAR(100) DEFAULT NULL,

    STATUS VARCHAR(50) DEFAULT 'Pending',

    customer_name VARCHAR(100) DEFAULT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    address TEXT DEFAULT NULL,
    city VARCHAR(100) DEFAULT NULL,
    pincode VARCHAR(20) DEFAULT NULL,

    total_amount DECIMAL(10,2) DEFAULT NULL,
    order_reference VARCHAR(100) DEFAULT NULL,

    INDEX idx_order_user (user_id),
    INDEX idx_order_product (product_id),
    INDEX idx_razorpay_order (razorpay_order_id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ==========================================
-- 3. USERS TABLE
-- ==========================================

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ==========================================
-- 4. WISHLIST TABLE
-- ==========================================

CREATE TABLE IF NOT EXISTS wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,
    product_id INT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY unique_user_product (user_id, product_id),

    INDEX idx_wishlist_user (user_id),
    INDEX idx_wishlist_product (product_id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ==========================================
-- END OF TABLE CREATION
-- ==========================================


INSERT INTO users (name, email, password, role)
VALUES ('Sourav', 'souravjha700377@gmail.com', '1234', 'admin');

UPDATE users
SET role = 'admin'
WHERE email = 'souravjha700377@gmail.com';




