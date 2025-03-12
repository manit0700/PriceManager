<?php
// Manit Bhaveshkumar Dankhara ID: 1002117492
// Christopher Pressley ID: 1001377684

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include 'Database.php';

// Initialize variables
$item_id = $_POST['item_id'] ?? null;
$item_name = $_POST['item_name'] ?? null;

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare the SQL query
    $sql = "SELECT * FROM `ITEM` WHERE (`iId` = ? OR `IName` = ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ss", $item_id, $item_name);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Item - Best Price Groceries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .no-results {
            color: red;
            font-weight: bold;
            margin-top: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Search for an Item</h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="insert_item.php">Insert Item</a>
            <a href="update_item.php">Update Item</a>
            <a href="delete_item.php">Delete Item</a>
        </nav>

        <form method="post">
            <input type="text" id="item_id" name="item_id" placeholder="Enter Item ID">
            <input type="text" id="item_name" name="item_name" placeholder="Enter Item Name">
            <input type="submit" value="Search">
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Item Description</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['iId']); ?></td>
                        <td><?php echo htmlspecialchars($row['IName']); ?></td>
                        <td><?php echo htmlspecialchars($row['SPrice']); ?></td>
                        <td><?php echo htmlspecialchars($row['IDescription'] ?? 'N/A'); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <p class="no-results">No results found.</p>
        <?php endif; ?>

        <?php
        // Close the statement and connection if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
