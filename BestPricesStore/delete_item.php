<?php
// Manit Bhaveshkumar Dankhara ID: 1002117492
// Christopher Pressley ID: 1001377684

session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the item name from the form
    $item_name = trim($_POST['item_name']);

    // Check if item name is empty
    if (empty($item_name)) {
        echo "<script>alert('Please enter the item name.'); window.history.back();</script>";
        exit;
    }

    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Fetch the iId of the item using the item name
        $fetchIdQuery = "SELECT iId FROM `ITEM` WHERE `IName` = ?";
        $stmt = $conn->prepare($fetchIdQuery);

        if ($stmt === false) {
            throw new Exception("Error preparing fetch ID query: " . $conn->error);
        }

        $stmt->bind_param("s", $item_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();

        if (!$item) {
            echo "<script>alert('No item found with the specified name.'); window.history.back();</script>";
            $stmt->close();
            $conn->rollback();
            exit;
        }

        $iId = $item['iId'];
        $stmt->close();

        // Delete related records in the STORE_ITEM table
        $deleteStoreItemQuery = "DELETE FROM `store_item` WHERE `iId` = ?";
        $stmt = $conn->prepare($deleteStoreItemQuery);

        if ($stmt === false) {
            throw new Exception("Error preparing delete STORE_ITEM query: " . $conn->error);
        }

        $stmt->bind_param("i", $iId);
        $stmt->execute();
        $stmt->close();

        // Delete related records in the ORDER_ITEM table
        $deleteOrderItemQuery = "DELETE FROM `order_item` WHERE `iId` = ?";
        $stmt = $conn->prepare($deleteOrderItemQuery);

        if ($stmt === false) {
            throw new Exception("Error preparing delete ORDER_ITEM query: " . $conn->error);
        }

        $stmt->bind_param("i", $iId);
        $stmt->execute();
        $stmt->close();

        // Delete the item from the ITEM table
        $deleteItemQuery = "DELETE FROM `ITEM` WHERE `iId` = ?";
        $stmt = $conn->prepare($deleteItemQuery);

        if ($stmt === false) {
            throw new Exception("Error preparing delete ITEM query: " . $conn->error);
        }

        $stmt->bind_param("i", $iId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Item deleted successfully.'); window.location.href = 'delete_item.php';</script>";
        } else {
            echo "<script>alert('No item found with the specified ID.'); window.history.back();</script>";
        }

        // Commit the transaction
        $conn->commit();
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.history.back();</script>";
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
    <title>Delete Item - Best Price Groceries</title>
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
        <h2>Delete Item</h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="insert_item.php">Insert Item</a>
            <a href="display_item.php">Display Item</a>
            <a href="update_item.php">Update Item</a>
        </nav>

        <form method="post">
            <label for="item_name">Item Name to Delete:</label><br>
            <input type="text" id="item_name" name="item_name" required><br>
            <input type="submit" value="Delete Item">
        </form>

        <div class="footer">
            <p>&copy; 2024 Best Price Groceries. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
