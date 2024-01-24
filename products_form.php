<?php

require 'vendor/autoload.php';



include_once "./db.php";



// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category = $_POST['category'];
    $price = $_POST['price'];
    $product_name = $_POST['product_name'];
    $available = $_POST['stock'];
    $admin_id = $_POST['admin_id'];
    $about = $_POST['about'];

    // Retrieve the uploaded file details
    $file = $_FILES['product_image'];
    $filename = $file['name'];
    $tempFilePath = $file['tmp_name'];

    // Sanitize the input
    $category = mysqli_real_escape_string($conn, $category);
    $price = mysqli_real_escape_string($conn, $price);
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $available = mysqli_real_escape_string($conn, $available);
    $admin_id = mysqli_real_escape_string($conn, $admin_id);
    $about = mysqli_real_escape_string($conn, $about);

    // Prepare the SQL statement
    $sql = "INSERT INTO product (category, price, product_name, stock, admin_id, about, product_image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("ssssiss", $category, $price, $product_name, $available, $admin_id, $about, $filename);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Move the uploaded file to a desired location
        $targetDirectory = "./uploads/product/";
        $targetFilePath = $targetDirectory . $filename;
        move_uploaded_file($tempFilePath, $targetFilePath);

        // Redirect or perform other actions as needed
        header("Location: shop.php");
        exit;
    } else {
        echo "Error inserting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

?>
