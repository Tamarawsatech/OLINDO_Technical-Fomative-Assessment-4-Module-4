CREATE DATABASE IF NOT EXISTS pos_tfa2
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE pos_tfa2;

DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS users;

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at DATETIME NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    avatar VARCHAR(255) NULL,
    created_at DATETIME NOT NULL
);

INSERT INTO customers (full_name, email, phone, created_at) VALUES
    ('Andrea Santos', 'andrea.santos@example.com', '0917-123-4567', '2026-09-29 09:00:00'),
    ('Joshua Reyes', 'joshua.reyes@example.com', '0918-234-5678', '2026-09-29 09:05:00'),
    ('Maria Cruz', 'maria.cruz@example.com', '0919-345-6789', '2026-09-29 09:10:00'),
    ('Carlo Mendoza', 'carlo.mendoza@example.com', '0920-456-7890', '2026-09-29 09:15:00'),
    ('Bianca Garcia', 'bianca.garcia@example.com', '0921-567-8901', '2026-09-29 09:20:00');

INSERT INTO users (username, full_name, created_at) VALUES
    ('admin01', 'Karl Michael Olindo', '2026-09-29 09:00:00'),
    ('cashier01', 'Angela Ramos', '2026-09-29 09:05:00'),
    ('cashier02', 'John Flores', '2026-09-29 09:10:00'),
    ('manager01', 'Nicole Bautista', '2026-09-29 09:15:00'),
    ('staff01', 'Mark Villanueva', '2026-09-29 09:20:00');
