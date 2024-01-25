<?php
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve order ID and status from the form
    $order_id = $_POST['order_id'];
    $status_order = $_POST['status_order'];

    // Insert a new record into the status table
    $insertStatusQuery = "INSERT INTO `status` (order_id, status_order) VALUES (?, ?)";
    $stmt = $conn->prepare($insertStatusQuery);
    $stmt->bind_param("is", $order_id, $status_order);

    if ($stmt->execute()) {
        // Order status inserted successfully
        header("Location: /eccomerce/order.php");
        exit;
    } else {
        // Failed to insert order status
        echo "Failed to insert order status: " . $stmt->error;
        error_log("Failed to insert order status: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();
}
?>
