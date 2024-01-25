<?php
include_once "./db.php";
session_start();

// Set default values for pagination and filtering
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Check if the search form is submitted
if (isset($_GET['search'])) {
    $searchKeyword = $_GET['search'];
    $query = "SELECT * FROM product WHERE product_name LIKE '%$searchKeyword%'";
} else {
    // Default query without search
    $query = "SELECT * FROM product";
}

// Apply category filter if selected
if (isset($_GET['category']) && $_GET['category'] !== '') {
    $categoryFilter = $_GET['category'];
    $query .= " WHERE category = '$categoryFilter'";
}

// Apply price filter if selected
if (isset($_GET['price']) && in_array($_GET['price'], ['ASC', 'DESC'])) {
    $priceFilter = $_GET['price'];
    $query .= " ORDER BY price $priceFilter";
}

// Add LIMIT and OFFSET for pagination
$query .= " LIMIT $limit OFFSET $offset";

// Execute the query
$result = mysqli_query($conn, $query);



$stock = 0; // You should replace this with the actual stock value from your database

// Example for a button
$buttonDisabled = ($stock == 0) ? 'disabled' : '';

// Example for a link
$linkDisabled = ($stock == 0) ? 'disabled' : '';










// Close the database connection
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/shop.css">

  
    <!-- Favicon  -->
    <link rel="icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/shop.css">
    <title>Document</title>
</head>
<body>

<?php include "./navbar.php" ?>

   
<div class="cart" id="cart">
    <span class="material-symbols-outlined">shopping_cart</span>
    <p id="cart-counter">0</p>
</div>

<div class="add_to_cart_box" id="add-to-cart-box" style="display: block;">
    <form id="cartForm" action="./add_to_cart_form.php" method="POST">
    <input type="hidden" value="<?php echo $id; ?>" name="user_id">

    <div id="cartItemsContainer"></div>
    <table class="table table-bordered border-secondary" id="cartTable">
    <thead>
        <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Stock</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="cartItemsContainers"></tbody>
</table>
        <div class="cart_name">
           
        </div>
        <div class="btn_cart" style="display:flex; flex-direction:column;">
            <input type="number" name="total_amount" value="" >
            <button type="submit" class="btn btn-primary">Place Order</button>
        </div>
    </form>
</div>


   
        
    <?php
   
// Check if the user's role is admin to display the form
if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
?>
 <br>
    <br>
    <h1>ADD PRODUCTS:</h1>
    <!--form-->
    <div class="form">
        <form method="POST" action="./products_form.php" enctype="multipart/form-data" style="margin:4rem;">
            <div class="row">
                <div class="col-md-6 mb-4 form-floating">
                    <select class="form-select" id="categories" name="category">
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
                    <input type="text" class="form-control" id="floatingInput1" placeholder="name@example.com" name="stock">
                    <label for="floatingInput1">Stock</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 form-floating">
                    <input type="text" class="form-control" id="floatingInput2" placeholder="Password" name="product_name">
                    
                    <label for="floatingInput2">Product Name</label>

                    
                </div>
                <div class="col-md-6 mb-4 form-floating">

                    <input type="hidden" class="form-control" name="admin_id" value="<?php echo $id; ?>">
                    <div class="ccol-sm-6 mb-4 form-floating">
                        <input type="file" class="form-control" id="floatingInput2" placeholder="Password" name="product_image">
                        <label for="floatingInput2">Product Picture</label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <textarea name="about" id="" cols="30" rows="10"></textarea>
                <label for="floatingInput2">About Product</label>
            </div>
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="form-control-submit-button btn btn-primary" style="width: 10%;">Add Product</button>
            </div>
        </form>
    </div>
<?php
}
?>
    
    

    <br>
    <br>
    <h1>PRODUCTS</h1>
    <br>
    <br>
    
<div class="box">
    <div class="inp">
        <div class="s">
            <form class="d-flex" method="GET" action="">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        


        <div class="filter">
            <!--Filter-->
            <form class="d-flex mt-3" method="GET" action="">
                <select class="form-select me-2" name="category">
                    <option value="">All Categories</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Light">Light</option>
                    <option value="Laptop">Laptop</option>
                    <option value="Home Accesories">Home Accesories</option>
                    <option value="Style Accesories">Style Accesories</option>
                </select>
                <select class="form-select me-2" name="price">
                    <option value="">Sort by Price</option>
                    <option value="ASC">Low to High</option>
                    <option value="DESC">High to Low</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit">Filter</button>
            </form>
        </div>
    </div>



    <div class="cards">
        
        <?php while ($row = mysqli_fetch_assoc($result)) {?>
            <div class="card shadow rounded" id="card_product" style="width: 12rem;">
            
            <?php
                // Check if the user's role is admin to display the form
                if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
                ?>
                    <div class="dropdown-container">
                            <div class="dropdown-button">
                                <span class="material-symbols-outlined">more_vert</span>
                                <div class="dropdown-content">
                                    <div class="dropdown-option">
                                    <a href="./extension/edit_product.php?product_id=<?php echo $row['product_id']; ?>&about=<?php echo $row['about']; ?>&category=<?php echo $row['category']; ?>&stock=<?php echo $row['stock']; ?>&product_image=<?php echo $row['product_image']; ?>&price=<?php echo $row['price']; ?>&product_name=<?php echo $row['product_name']; ?>" class="btn order">Edit</a>
                                    </div>
                                    <div class="dropdown-option">
                                        <form action="./extension/delete_product.php" method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }?>
                
                        
                        
                <img src="./uploads/product/<?php echo $row['product_image']; ?>" alt="" class="card-img-top">
                <div class="card-body">
                    <h6 class="card-title" style="text-align:center;"><?php echo $row['product_name']; ?></h6>
                    
                    <div class="pr_st d-flex">
                        <p>Price: <?php echo $row['price']; ?></p>
                        <p>Stock:  <?php echo $row['stock']; ?></p>
                    </div>
                    <!-- Inside the while loop where you display products -->
                    <div class="btn_product d-flex">
                        <?php if ($row['stock'] >= 1){ ?>
                    <button class="btn add" onclick="addToCart('<?php echo $row['product_name']; ?>', <?php echo $row['price']; ?>, <?php echo $row['stock']; ?>, <?php echo $row['product_id']; ?>)">Add to Cart</button>

                    <a href="./extension/place_order.php?product_id=<?php echo $row['product_id']; ?>&product_image=<?php echo $row['product_image']; ?>&price=<?php echo $row['price']; ?>&product_name=<?php echo $row['product_name']; ?>" class="btn order">Order</a>
                    <?php } else {?>
                        <h6 style="text-align:center; color:#cccc;">Out of Stock</h6>
                    <?php } ?>
                    </div>

                </div>
            </div>
        <?php } ?>
        
    </div>

    <nav aria-label="Page navigation example" style="display:flex; justify-content:center;">
        <ul class="pagination">
            <?php
            // Get total number of products for pagination
            $totalQuery = "SELECT COUNT(*) as total FROM product";
            $totalResult = mysqli_query($conn, $totalQuery);
            $totalRow = mysqli_fetch_assoc($totalResult);
            $totalPages = ceil($totalRow['total'] / $limit);

            // Previous page link
            if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
            }

            // Page links
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }

            // Next page link
            if ($page < $totalPages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>

<script src="./js/shop.js"></script>

</body>
</html>