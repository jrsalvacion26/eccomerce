<?php
include_once "../db.php"; // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $product_name = $_POST['product_name'];
    $admin_id = $_POST['admin_id']; // Update to admin_id
    $product_id = $_POST['product_id'];
    $about = $_POST['about'];

    // Retrieve the uploaded file details
    $file = $_FILES['product_image'];
    $filename = $file['name'];
    $tempFilePath = $file['tmp_name'];

    // Initialize $product_image
    $product_image = $filename; // Assuming you want to store the filename in the database

    // Update the product information in the database
    $updateQuery = "UPDATE product 
                    SET category = ?, price = ?, stock = ?, product_name = ?, admin_id = ?, product_image = ?, about = ?
                    WHERE product_id = ?";

    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssssi", $category, $price, $stock, $product_name, $admin_id, $product_image, $about, $product_id);

    if ($stmt->execute()) {
        // Move the uploaded file to a desired location
        $targetDirectory = "../uploads/product/";
        $targetFilePath = $targetDirectory . $filename;
        move_uploaded_file($tempFilePath, $targetFilePath);

        header("Location: /eccomerce/shop.php");
        exit;
    } else {
        // Failed to update product
        echo "Failed to update product: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/shop.css">
    <title>Document</title>
</head>
<body>
    <?php include "./navbar.php" ?>
    <h1>EDIT PRODUCT</h1>

    
    <!--form-->
    <div class="card form">
        <form method="POST" action="" enctype="multipart/form-data" style="margin:4rem;">
            <div class="row">
                <div class="col-md-6 mb-4 form-floating">
                    <select class="form-select" id="categories" name="category">
                    <option value="Furniture"><?php echo $_GET['category']; ?></option>
                        <option value="Furniture">Furniture</option>
                        <option value="Light">Light</option>
                        <option value="Antihistamines">Laptop</option>
                        <option value="Home Accesories">Home Accesories</option>
                        <option value="Style Accesories">Style Accesories</option>
                        </select>
                        <label for="categories">Categories</label>
                        
                </div>
                <div class="col-sm-6 mb-4 form-floating">
                    <input type="text" class="form-control" id="floatingInput1" placeholder="name@example.com" name="price">
                    <label for="floatingInput1">Price</label>
                </div>
                <div class="col-sm-6 mb-4 form-floating">
                    <input type="text" class="form-control" id="floatingInput1" placeholder="name@example.com" name="stock" value="<?php echo $_GET['stock']; ?>">
                    <label for="floatingInput1">Stock</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 form-floating">
                    <input type="text" class="form-control" id="floatingInput2" placeholder="Password" name="product_name" value="<?php echo $_GET['product_name']; ?>">
                    
                    <label for="floatingInput2">Product Name</label>

                    
                </div>
                <div class="col-md-6 mb-4 form-floating">

                    <input type="hidden" class="form-control" name="admin_id" value="<?php echo $id; ?>">
                    <input type="hidden" class="form-control" name="product_id" value="<?php echo $_GET['product_id']; ?>">
                    <div class="ccol-sm-6 mb-4 form-floating">
                        <input type="file" class="form-control" id="floatingInput2"  name="product_image" value="<?php echo $_GET['product_image']; ?>">
                        <label for="floatingInput2">Product Picture</label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <textarea name="about" id="" cols="30" rows="10"><?php echo $_GET['about']; ?></textarea>
                <label for="floatingInput2">About Product</label>
            </div>
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="form-control-submit-button btn btn-primary" style="width: 10%;">Edit Product</button>
            </div>
        </form>
    </div>


</body>
</html>