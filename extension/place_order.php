<?php
include "../db.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    // Get the product_id, price, and quantity from the form
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
        // Order placed successfully, now update the product stock
        $updateStockQuery = "UPDATE product SET stock = stock - ? WHERE product_id = ?";
        $stmtUpdateStock = $conn->prepare($updateStockQuery);
        $stmtUpdateStock->bind_param("ii", $quantity, $product_id);

        if ($stmtUpdateStock->execute()) {
            // Stock updated successfully
            header("Location: ../order.php");
            exit;
        } else {
            // Failed to update stock
            echo "Failed to update stock.";
        }

        // Close the statement for updating stock
        $stmtUpdateStock->close();
    } else {
        // Failed to place order
        echo "Failed to place order.";
    }

    // Close the statement for inserting order
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../">
    <title>Place Order</title>
</head>
<style>
    #cart_id{
        display:flex;
        align-items:center;
        justify-content:center;
        min-width: 20em;
        width: 50rem;
    }

    form
        {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin:.3rem;
        }

    .center_natin{
        display: flex;
        justify-content:center;
    }
</style>
<body>
    <?php include "./navbar.php" ?>
    <h1>Place Order</h1>
    
    <!-- Add a form to input quantity -->
<!-- Add a form to input quantity -->

<div class="center_natin">
<div class="card" id="cart_id">
    <form method="POST" action="">
        <div class="mb-3">
            <img src="../image/<?php echo $_GET['product_image']; ?>" alt="" srcset="" class="card-img-top">
            
        </div>
        <div class="card-body">
            <div class="cart-title">
                <h1><?php echo $_GET['product_name']; ?></h1>
                <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
                <label for="price">Price:</label>
                <input type="number" name="price" value="<?php echo $_GET['price']; ?>">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary" name="place_order">Place Order</button>
    </form>
</div>

</div>


</body>
</html>
