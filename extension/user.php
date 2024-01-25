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



// Perform the query to get total order amount for the user
$queryTotalAmount = "SELECT user_id, SUM(total_amount) AS total_order_amount FROM `order` WHERE user_id = ? GROUP BY user_id";
$stmtTotalAmount = $conn->prepare($queryTotalAmount);
$stmtTotalAmount->bind_param("i", $user_id);
$stmtTotalAmount->execute();
$resultTotalAmount = $stmtTotalAmount->get_result();

// Check if there are results for the total order amount
if ($rowTotalAmount = $resultTotalAmount->fetch_assoc()) {
    $total_order_amount = $rowTotalAmount['total_order_amount'];
} else {
    $total_order_amount = 0;
}






// Close the statement for total order amount
$stmtTotalAmount->close();

    // Close the statement
    $stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    
    <h1 style="font-weight:800; margin:1rem;">CUSTOMER ORDERS</h1>



    <div class="container mt-4" style="display:flex; flex-direction:column; align-items:center;">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="./image/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $row['product_name']; ?></h3>
                            <p class="card-text">Order ID: <?php echo $row['order_id']; ?></p>
                            <p class="card-text">Quantity: <?php echo $row['quantity']; ?></p>
                            <p class="card-text">Total Amount: $<?php echo $row['total_amount']; ?></p>
                            <p class="card-text">Order Date: <?php echo $row['order_date']; ?></p>
                            <p class="card-text">Order Time: <?php echo $row['order_time']; ?></p>
                        </div>

                        <div class="btn_customer_order">
                            <form action="../eccomerce/extension/cancel_order.php" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                <input type="hidden" name="status_order" value="cancelled">
                                <button type="submit" class="btn btn-Danger">Cancel</button>
                            </form>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
      
    </div>

    <h1 style="font-weight:800; text-align:right;">Total Amount: $<?php echo number_format($total_order_amount, 2, '.', ','); ?></h1>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>