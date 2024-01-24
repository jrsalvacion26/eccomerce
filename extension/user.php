<?php


// Get the user_id from the session
$user_id = $_SESSION['user_id'];

// Fetch the orders of the user with product details from the database
$selectOrdersQuery = "SELECT o.order_id, o.product_id, o.quantity, o.total_amount, o.order_date, o.order_time, p.product_name, p.product_image
                      FROM `order` o
                      JOIN product p ON o.product_id = p.product_id
                      WHERE o.user_id = ?";
$stmt = $conn->prepare($selectOrdersQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>USER</h1>

    <h1>User Orders</h1>

    <div class="container mt-4" style="display:flex; flex-direction:column; align-items:center;">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="uploads/product/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $row['product_name']; ?></h3>
                            <p class="card-text">Order ID: <?php echo $row['order_id']; ?></p>
                            <p class="card-text">Quantity: <?php echo $row['quantity']; ?></p>
                            <p class="card-text">Total Amount: $<?php echo $row['total_amount']; ?></p>
                            <p class="card-text">Order Date: <?php echo $row['order_date']; ?></p>
                            <p class="card-text">Order Time: <?php echo $row['order_time']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
      
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>