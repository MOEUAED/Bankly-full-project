-- 1. CREATE DATABASE bankly_f ; 
CREATE DATABASE bankly_f ;

-- 2. USE DATABASE FOR CREATE TABLES ;
USE bankly_f ;

-- 3. CREATE FIRST TABLE customers ;
CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20),
    registration_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 4. CREATE SECONDE TABLE advisors ;
CREATE TABLE advisors (
    advisor_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE
);

-- 5. CREATE THIRD TABLE accounts ;
CREATE TABLE accounts (
    account_id INT AUTO_INCREMENT PRIMARY KEY,
    account_number VARCHAR(50) UNIQUE NOT NULL,
    balance DECIMAL(10,2) DEFAULT 0,
    account_type ENUM('Checking', 'Savings', 'Business') NOT NULL,
    customerid INT,
    advisorid INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customerid) REFERENCES customers(customer_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (advisorid) REFERENCES advisors(advisor_id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- 6. CREATE FOURTH TABLE transactions ;
CREATE TABLE transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10,2) NOT NULL,
    transaction_type ENUM('debit', 'credit') NOT NULL,
    transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    accountid INT,
    FOREIGN KEY (accountid) REFERENCES accounts(account_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);