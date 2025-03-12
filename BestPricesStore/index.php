<?php
// Manit Bhaveshkumar Dankhara ID: 1002117492
// Christopher Pressley ID: 1001377684

include 'Database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Price Groceries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007BFF;
            margin-bottom: 20px;
        }
        nav {
            margin-bottom: 20px;
        }
        nav a {
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        nav a:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Best Price Groceries</h1>
        <nav>
            <a href="display_item.php">Display Item</a>
            <a href="insert_item.php">Insert Item</a>
            <a href="update_item.php">Update Item</a>
            <a href="delete_item.php">Delete Item</a>
        </nav>
        <p>Your one-stop shop for the best prices on groceries. Manage your items easily using the options above.</p>
        <div class="footer">
            <p>&copy; 2024 Best Price Groceries. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
