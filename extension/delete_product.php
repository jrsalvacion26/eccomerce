<?php
include_once "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve product ID from the form
    $product_id = $_POST['product_id'];

    // Perform the delete query
    $deleteQuery = "DELETE FROM product WHERE product_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            // Product deleted successfully
            header("Location: /eccomerce/shop.php");
            exit;
        } else {
            // Failed to delete product
            echo "Failed to delete product: " . $stmt->error;
        }

    // Close the statement
    $stmt->close();
}

// Close the database connection
mysqli_close($conn);
?>
