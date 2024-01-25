<?php
include "../db.php";

// Get user_id from the URL parameter
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;

// Pagination variables
$limit = 5; // Number of orders per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page

// Calculate the offset for the SQL query
$offset = ($page - 1) * $limit;

// Query to get orders for the user with product details using LIMIT and OFFSET
$sql = "SELECT o.order_id, p.product_name, o.quantity
        FROM `order` o
        INNER JOIN `product` p ON o.product_id = p.product_id
        WHERE o.user_id = $user_id
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

if ($result === false) {
    die("Error executing the query: " . $conn->error);
}

// Count total number of orders for pagination
$totalOrdersSql = "SELECT COUNT(*) as total FROM `order` WHERE user_id = $user_id";
$totalOrdersResult = $conn->query($totalOrdersSql);
$totalOrdersRow = $totalOrdersResult->fetch_assoc();
$totalOrders = $totalOrdersRow['total'];

// Calculate the total number of pages
$totalPages = ceil($totalOrders / $limit);
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
    <?php include "./navbar.php" ?>
<h1>Customer Orders</h1>
    <div class="container mt-4">
        

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

            <!-- Pagination Links -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?user_id=<?php echo $user_id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        <?php } else { ?>
            <p class="alert alert-warning">No orders found for this user</p>
        <?php } ?>

        <?php $conn->close(); ?>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
