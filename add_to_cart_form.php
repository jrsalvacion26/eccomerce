<?php

include "./db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the POST request
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $product_ids = isset($_POST['product_id']) ? $_POST['product_id'] : [];
    $quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];
    $total_amounts = isset($_POST['total_amount']) ? $_POST['total_amount'] : '';

    // Check if total_amount is set
    if (isset($total_amounts)) {
        // Get the current date and time
        $order_date = date("Y-m-d");
        $order_time = date("H:i:s");

        // Iterate over each product and insert into the database
        for ($i = 0; $i < count($product_ids); $i++) {
            $product_id = $product_ids[$i];
            $quantity = $quantities[$i];
            $total_amount = $total_amounts;

            // Update stock in the product table
            $updateStockSQL = "UPDATE product SET stock = stock - '$quantity' WHERE product_id = '$product_id'";
            if ($conn->query($updateStockSQL) !== TRUE) {
                echo "Error updating stock: " . $conn->error;
            }

            // Assuming you have user and product tables with user_id and product_id as primary keys
            $insertOrderSQL = "INSERT INTO `order` (user_id, product_id, quantity, total_amount, order_date, order_time)
                    SELECT u.user_id, p.product_id, '$quantity', '$total_amount', '$order_date', '$order_time'
                    FROM user u
                    JOIN product p ON p.product_id = '$product_id'
                    WHERE u.user_id = '$user_id'";

            if ($conn->query($insertOrderSQL) !== TRUE) {
                echo "Error inserting order: " . $conn->error;
            }
        }

        header("Location: shop.php");
    } else {
        echo "Error: Total amount not set.";
    }
} else {
    // If the form is not submitted, display an error message
    echo "Error: Form not submitted.";
}

// Close the database connection
mysqli_close($conn);

?>
