<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/shop.css">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="./Inventory System/css/bootstrap.min.css" rel="stylesheet">
    <link href="./Inventory System/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="./Inventory System/css/swiper.css" rel="stylesheet">
    <link href="./Inventory System/css/styles.css" rel="stylesheet">
    <link href="./Inventory System/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <!-- Favicon  -->
    <link rel="icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<?php include "./navbar.php" ?>

<?php
// Check if the user's role is admin to display the form
if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
?>
    <?php include "./extension/admin.php"?>
<?php
} else {
?>
    <?php include "./extension/user.php"?>
<?php
}
?>


</body>
</html>