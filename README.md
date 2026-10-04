# CodeIgniter POS Database Activity

This CodeIgniter 4 POS application displays customer and user accounts from the MySQL database `pos_tfa2`. The account pages use CodeIgniter Models and Query Builder instead of static PHP arrays.

## Requirements

- PHP 8.2 or newer
- Composer
- MySQL or XAMPP

## Setup

1. Start Apache and MySQL in XAMPP.
2. Import `database/pos_tfa2.sql` in phpMyAdmin, or run `C:\xampp\mysql\bin\mysql.exe -u root < database\pos_tfa2.sql`.
3. Confirm the database settings in `.env` use database `pos_tfa2`, username `root`, blank password, and the `MySQLi` driver.
4. Run `php spark serve` from this directory.
5. Open `http://localhost:8080/`, then use the Customers and Users links.

## Project structure

- `app/Models/CustomerModel.php` reads the `customers` table.
- `app/Models/UserModel.php` reads the `users` table.
- `app/Controllers/Customers.php` and `app/Controllers/Users.php` retrieve records with `findAll()`.
- `app/Views/customers.php` and `app/Views/users.php` display the database records.
- `database/pos_tfa2.sql` is the database export containing the required schema and sample data.
