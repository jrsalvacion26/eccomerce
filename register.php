<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- SEO Meta Tags -->
        <meta name="description" content="Your description">
        <meta name="author" content="Your name">

        <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
        <meta property="og:site_name" content="" /> <!-- website name -->
        <meta property="og:site" content="" /> <!-- website link -->
        <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
        <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
        <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
        <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
        <meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

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


        <style>
            *{
  list-style: none;
  
}
body{
  background:#FBFBFB;
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
    border:2px solid black;
    background-color:black;
    color:white;
    min-height:8rem;
    
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



#navs{
  min-height:4rem;
  border-bottom:2px solid #F41F4E;
  background:#FFC2C7;
}





#navs li a{
  display:flex;
  font-size: clamp(1rem, 1.5vw, 1rem);
  gap:1rem;
  color:black;
  text-decoration:none;
  font-weight:800;
}

.text-box{
    background:linear-gradient(120deg, #FBFBFB,#FBFBFB);
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}

        </style>
    </head>
    <body>
        
    <nav id="admin">
        <h1>Clinica De Medicina</h1>
        
        <div class="form-group">
            <div class="group">
                <span class="material-symbols-outlined">help</span><h5>Support</h5>
            </div>

            <div class="group">
                <span class="material-symbols-outlined">settings</span><h5>Settings</h5>
            </div>

            <div class="group">
                <h5>Login</h5>
            </div>
</div>

</nav>



        <!-- Form -->
        <div class="ex-form-1 pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3">
                        <div class="text-box mt-5 mb-5 bg-gray">
                            <p class="mb-4">You have existing Account? Then please <a class="blue" href="./log-in.php">Log In</a></p>

                            <!-- Log In Form -->
                            <form method="POST" action="./registration_form.php" enctype="multipart/form-data">
                            <div class="mb-4 form-floating">
                                    <input type="name" class="form-control" id="floatingInput1" placeholder="name@example.com" name="fullname">
                                    <label for="floatingInput1">Fullname</label>
                                </div>
                                <div class="mb-4 form-floating">
                                    <input type="email" class="form-control" id="floatingInput1" placeholder="name@example.com" name="username">
                                    <label for="floatingInput1">Username</label>
                                </div>
                                <div class="mb-4 form-floating">
                                    <input type="password" class="form-control" id="floatingInput2" placeholder="Password" name="password">
                                    <label for="floatingInput2">Password</label>
                                </div>
                                <div class="mb-4 form-floating d-flex align-items-center">
                                    <select class="form-select" id="categories" name="role" style="width:30%;">
                                            <option value="Admin">Admin</option>
                                            <option value="User">Customer</option>
                                        </select>
                                        <label for="categories">Role:</label>

                                        
                                </div>
                                
                                
                                <div class="mb-4 form-floating">
                                    <input type="file" class="form-control" id="floatingInput2" placeholder="Password" name="profile_picture">
                                    <label for="floatingInput2">Profile Picture</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control-submit-button">Register</button>
                                </div>
                            </form>
                            <!-- end of log in form -->

                        </div> <!-- end of text-box -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of ex-form-1 -->
        <!-- end of form -->


    </body>
</html>