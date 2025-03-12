# BestPricesStore

## Overview
BestPricesStore is a PHP-based inventory management system that allows users to perform CRUD (Create, Read, Update, Delete) operations on product items using a MySQL database. The project includes an interactive interface to manage product data efficiently.

## Features
- Add new items to the database
- Update existing item details
- Delete items from the database
- Display available items in the inventory
- Connects to a MySQL database via PHP

## Technologies Used
- **Backend**: PHP
- **Database**: MySQL (phpMyAdmin)
- **Server**: Apache (XAMPP, LAMP, or WAMP)
- **Frontend**: HTML, CSS (if applicable)

## Project Structure
```
/BestPricesStore
│── Database.php        # Database connection
│── index.php           # Main entry point
│── insert_item.php     # Insert new items into the database
│── delete_item.php     # Delete items from the database
│── update_item.php     # Update item details
│── display_item.php    # Display stored items
│── /database           # (Optional) SQL export file for database setup
```

## Installation & Setup
1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/BestPricesStore.git
   ```
2. **Import the Database**
   - Open **phpMyAdmin**
   - Create a new database (e.g., `bestpricesstore`)
   - Import the provided `.sql` file in the `/database` folder (if available)
3. **Configure Database Connection**
   - Open `Database.php`
   - Update the credentials (host, username, password, database name)
   ```php
   $host = "localhost";
   $user = "root";
   $password = ""; # Change if necessary
   $database = "bestpricesstore";
   ```
4. **Run the Project**
   - Start Apache and MySQL in XAMPP/WAMP/LAMP
   - Open a web browser and visit:
     ```
     http://localhost/BestPricesStore/index.php
     ```

## Usage
- **Insert Items**: Use `insert_item.php` to add products.
- **Delete Items**: `delete_item.php` removes records.
- **Update Items**: Modify details via `update_item.php`.
- **Display Items**: `display_item.php` shows all stored products.

## Future Enhancements
- Add a login system for admin authentication
- Improve the UI with Bootstrap
- Implement AJAX for smoother operations

## License
This project is licensed under the MIT License.

---
Feel free to contribute by submitting a pull request!

