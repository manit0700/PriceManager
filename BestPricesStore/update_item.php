<?php
// Manit Bhaveshkumar Dankhara ID: 1002117492
// Christopher Pressley ID: 1001377684

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $old_name = trim($_POST['old_name']) ?? '';
    $new_name = trim($_POST['new_name']) ?? '';

    // Validate inputs
    if (empty($old_name) || empty($new_name)) {
        echo "<script>alert('Please provide both the old item name and the new item name.'); window.history.back();</script>";
        exit;
    }

    // Prepare the SQL query
    $sql = "UPDATE `ITEM` SET `IName` = ? WHERE `IName` = ?";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    // Bind the parameters (s = string)
    $stmt->bind_param("ss", $new_name, $old_name);

    // Execute the query
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Item updated successfully.'); window.location.href = 'update_item.php';</script>";
        } else {
            echo "<script>alert('No item found with the specified old name.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item - Best Price Groceries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007BFF;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        nav {
            margin-bottom: 20px;
        }
        nav a {
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
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
        <h2>Update Item</h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="insert_item.php">Insert Item</a>
            <a href="display_item.php">Display Item</a>
            <a href="delete_item.php">Delete Item</a>
        </nav>

        <form method="post">
            <label for="old_name">Old Item Name:</label><br>
            <input type="text" id="old_name" name="old_name" required><br>

            <label for="new_name">New Item Name:</label><br>
            <input type="text" id="new_name" name="new_name" required><br>

            <input type="submit" value="Update Item">
        </form>

        <div class="footer">
            <p>&copy; 2024 Best Price Groceries. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
