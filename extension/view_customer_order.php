<?php
include "../db.php";

// Get user_id from the URL parameter
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;

// Query to get all orders for the user with product details
$sql = "SELECT o.order_id, p.product_name, o.quantity
        FROM `order` o
        INNER JOIN `product` p ON o.product_id = p.product_id
        WHERE o.user_id = $user_id";

$result = $conn->query($sql);

if ($result === false) {
    die("Error executing the query: " . $conn->error);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    

<div class="container mt-4">
    <h2>Customer Orders</h2>

    <?php if ($result->num_rows > 0) { ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while ($order = $result->fetch_assoc()) { ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order ID: <?php echo $order['order_id']; ?></h5>
                            <p class="card-text">Product: <?php echo $order['product_name']; ?></p>
                            <p class="card-text">Quantity: <?php echo $order['quantity']; ?></p>
                            <!-- Add more details as needed -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p class="alert alert-warning">No orders found for this user</p>
    <?php } ?>

    <?php $conn->close(); ?>
</div>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
