<?php
// Manit Bhaveshkumar Dankhara ID: 1002117492
// Christopher Pressley ID: 1001377684

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include 'Database.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form input values
    $item_id = trim($_POST['item_id']) ?? '';
    $item_name = trim($_POST['item_name']) ?? '';
    $item_price = trim($_POST['item_price']) ?? '';
    $item_description = trim($_POST['item_description']) ?? '';

    // Validate inputs
    if (empty($item_id) || empty($item_name) || empty($item_price)) {
        echo "<script>alert('Please provide item ID, item name, and item price.'); window.history.back();</script>";
        exit;
    }

    // Convert item_price to a float
    $item_price = floatval($item_price);
    $item_id = intval($item_id);

    // Prepare the SQL query
    $sql = "INSERT INTO `ITEM` (`iId`, `IName`, `SPrice`, `IDescription`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    // Bind the parameters (i = integer, s = string, d = double/decimal)
    $stmt->bind_param("isds", $item_id, $item_name, $item_price, $item_description);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('New item added successfully.'); window.location.href = 'insert_item.php';</script>";
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
    <title>Insert New Item - Best Price Groceries</title>
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
        input[type="text"], input[type="number"] {
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
        <h2>Insert New Item</h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="display_item.php">Display Item</a>
            <a href="update_item.php">Update Item</a>
            <a href="delete_item.php">Delete Item</a>
        </nav>

        <form method="post">
            <label for="item_id">Item ID:</label><br>
            <input type="number" id="item_id" name="item_id" required><br>

            <label for="item_name">Item Name:</label><br>
            <input type="text" id="item_name" name="item_name" required><br>

            <label for="item_price">Item Price:</label><br>
            <input type="number" id="item_price" name="item_price" step="0.01" required><br>

            <label for="item_description">Item Description:</label><br>
            <input type="text" id="item_description" name="item_description"><br>

            <input type="submit" value="Insert Item">
        </form>

        <div class="footer">
            <p>&copy; 2024 Best Price Groceries. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
