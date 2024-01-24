<?php
include_once "../db.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    // Get the product_id and price from the form
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity']; // You should get this value from your form

    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Calculate total_amount
    $total_amount = (int)$quantity * (int)$price;

    // Get the current date and time
    $order_date = date("Y-m-d");
    $order_time = date("H:i:s");

    // Insert order details into the order table
    $insertOrderQuery = "INSERT INTO `order` (user_id, product_id, quantity, total_amount, order_date, order_time) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertOrderQuery);
    $stmt->bind_param("iiisss", $user_id, $product_id, $quantity, $total_amount, $order_date, $order_time);
    
    if ($stmt->execute()) {
        // Order placed successfully
        header("Location: ../order.php");
        exit;
    } else {
        // Failed to place order
        echo "Failed to place order.";
    }

    // Close the statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
</head>
<body>
    <h1>Place Order</h1>
    
    <!-- Add a form to input quantity -->
<!-- Add a form to input quantity -->
<form method="POST" action="">
    <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
    <input type="hidden" name="price" value="<?php echo $_GET['price']; ?>">
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" required>
    <button type="submit" name="place_order">Place Order</button>
</form>


</body>
</html>
