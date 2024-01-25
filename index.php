


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


     <!-- Styles -->

 
    <link rel="stylesheet" href="./extension/Dashboard/admin_style.css">
     <!-- Favicon  -->
    
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

     <link rel="stylesheet" href="./styles/index.css">
</head>
<style>
   
</style>
<body>
<?php include "./navbar.php" ?>

 

    
<?php
// Check if the user's role is admin to display the form
if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
?>
    <?php include_once "./extension/Dashboard/admin.php"?>
<?php
} else {
?>
    <?php include "./extension/Dashboard/user.php"?>
<?php
}
?>
    

    
    <footer>
        <div class="contact">
            <h5>Contact US</h5>
            <p>GADGET TECH STORE</p>
            <p>NO. 1259 Freedom, BGC</p>
            <p>gadgettech@gmail.com</p>
        </div>

        <div class="information">
            <h5>Information</h5>
            <p>Product Support</p>
            <p>Checkout</p>
            <p>License Policy</p>
            <p>Affiliate</p>
        </div>

        <div class="customer_service">
            <h5>Customer Service</h5>
            <p>Help Center</p>
            <p>Redeem Voucher</p>
            <p>Contact Us</p>
            <p>Policies & Rules</p>
        </div>
    </footer>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/chart.js"></script>

</body>

</html>