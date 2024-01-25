    <?php
    include "../db.php";
    
    // Check if a session is not already active
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    //session_status();
    // Check if the user is not logged in
    if (!isset($_SESSION['username'])) {
       
      
        header("Location: login.php");
        exit;
    }

    // Retrieve the username from the session variable
    $username = $_SESSION['username'];

    // Retrieve the filename of the profile picture from the database
    // Assuming you have a table called 'users' with a column 'profile_picture' storing the filename
    $query = "SELECT profile_picture, fullname, user_id,role FROM user WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($profilePictureFilename, $fullname,$id,$role);


    // Fetch the result
    if ($stmt->fetch()) {
        // Store the filename in the session variable
        $_SESSION['profile_picture'] = $profilePictureFilename;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['user_id'] = $id;
        $_SESSION['role'] = $role;
    }

    // Close the statement
    $stmt->close();


    ?>

      <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600&display=swap" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/fontawesome-all.min.css" rel="stylesheet">
        <link href="css/swiper.css" rel="stylesheet">
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="../styles/index.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <style>

*{
  list-style: none;
  
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropbtn {
  background-color: #f1f1f1;
  color: #333;
  padding: 10px;
  border: none;
  cursor: pointer;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.dropdown-content a {
  color: #333;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.group{
  display:flex;
  gap:1rem;
  padding-top:1rem;
}

#navs span{
  font-size: clamp(1rem, 1.5vw, 2rem);
}
#navs span:hover{
  transition:.2s ease-in-out;
  transform: scale(1.5);
}

.dropdown:hover .dropdown-content {
  display: block;
}

#admin{
    display:flex;
    justify-content:space-around;
    align-items:center;
    border-bottom:2px solid #7f8fa6;
    background:linear-gradient(120deg,#B19886,#523A28);
    
    
    
}
#admin h1,h5{
  color:white;
}

.form-group{
    display:flex;
    justify-content:space-between;
    gap:3rem;
}
.profile {
  display:flex;
  gap:1rem;
}

.profile img{
  height:3rem;
  width: 3rem;
  border-radius:50%;
}

.profile button{
  background:none;
  color:white;
}

#navs{
  min-height:4rem;
  border-bottom:2px solid gray;
  background:#7f8fa6;
}

#navs ul{
  display:flex;
  padding-top:12px;
  justify-content:space-evenly;
  align-items:center;
                                                 
}



#navs li a{
  display:flex;
  font-size: clamp(1rem, 1.5vw, 1rem);
  gap:1rem;
  color:black;
  text-decoration:none;
  font-weight:800;
}
</style>


    <nav id="admin">
        <h1>SavoryHarbor</h1>
        
        <div class="form-group">
            <div class="group">
                <span class="material-symbols-outlined" style="color:white;">help</span><h5>Support</h5>
            </div>

            <div class="group">
                <span class="material-symbols-outlined" style="color:white;">settings</span><h5>Settings</h5>
            </div>

            <div class="group">
                <span class="material-symbols-outlined" style="color:white;">notifications</span>
            </div>

            <div class="group profile" style="display:flex; align-items:center;">
          <!-- Display the profile picture -->
          <img src="<?php echo $profilePictureFilename; ?>" alt="Profile Picture" class="profile-picture">

          <?php
if (!isset($_SESSION['username'])) {
    // User is not logged in
    ?>
    <h5>Login</h5>
<?php
} else {
    // User is logged in, fetch the username and assign it to $admin_admin
    $admin_id = $_SESSION['user_id'];
    ?>
    <h5><?php echo $fullname; ?></h5>
    
<?php
}
?>


          <div class="dropdown">
              <button onclick="toggleDropdown()" class="dropbtn"><span class="material-symbols-outlined" >expand_more</span></button>
              <div id="myDropdown" class="dropdown-content" >
                  <a href="./logout.php">Logout</a>
              </div>
          </div>
</div>

</nav>

<div class="another_nav">
   <!--nav-->
   <nav id="nav">
        <ul id="nav_ul">
            <li><a href="/eccomerce/index.php">HOME</a></li>
            <li><a href="/eccomerce/shop.php">SHOP</a></li>
            <li><a href="/eccomerce/index.php">ORDER</a></li>
            
        </ul>
    </nav>
</div>

<script>
    function toggleDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}
function logout() {
  // Perform logout logic here
  alert("Logout clicked");
}

</script>