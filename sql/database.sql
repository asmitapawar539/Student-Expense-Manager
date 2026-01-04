CREATE DATABASE expense_manager;
USE expense_manager;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100),
 email VARCHAR(100) UNIQUE,
 password VARCHAR(255)
);

CREATE TABLE categories (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 name VARCHAR(50)
);

CREATE TABLE expenses (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 category_id INT,
 amount DECIMAL(10,2),
 expense_date DATE,
 note VARCHAR(255)
);

CREATE TABLE budgets (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 monthly_budget DECIMAL(10,2)
);
