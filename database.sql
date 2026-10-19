CREATE DATABASE IF NOT EXISTS expenses_db;
USE expenses_db;

CREATE TABLE IF NOT EXISTS categories(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50)
);

INSERT INTO categories (name) VALUES
('Food'), ('Transport'), ('School'), ('Bills'), ('Entertainment'), ('Other');

CREATE TABLE IF NOT EXISTS expenses(
    id INT PRIMARY KEY AUTO_INCREMENT,
    amount DECIMAL(10,2),
    description VARCHAR(255),
    category_id INT,
    FOREIGN KEY category_id REFERENCES categories(id),
    expense_date DATE,
    created_at TIMESTAMP DEFAULT(CURRENT_TIME)
)