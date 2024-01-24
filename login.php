

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
        
        <!-- Webpage Title -->
        <title>Log In</title>
        
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600&display=swap" rel="stylesheet">
        <link href="./Inventory System/css/bootstrap.min.css" rel="stylesheet">
        <link href="./Inventory System/css/fontawesome-all.min.css" rel="stylesheet">
        <link href="./Inventory System/css/swiper.css" rel="stylesheet">
        <link href="./Inventory System/css/styles.css" rel="stylesheet">
        <link href="./Inventory System/css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <!-- Favicon  -->
        <link rel="icon" href="images/favicon.png">
    </head>
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
    <body>

    <nav id="admin">
        <h1>GADGET TECH</h1>
        
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
                        <div class="text-box mt-5 mb-5 ">
                            <p class="mb-4">You don't have a password? Then please <a class="blue" href="./register.php">Sign Up</a></p>

                            <!-- Log In Form -->
                            <form method="POST" action="./login_form.php" >
                                <div class="mb-4 form-floating">
                                    <input type="email" class="form-control" id="floatingInput1" placeholder="name@example.com" name="username">
                                    <label for="floatingInput1">Email</label>
                                </div>
                                <div class="mb-4 form-floating">
                                    <input type="password" class="form-control" id="floatingInput2" placeholder="Password" name="password">
                                    <label for="floatingInput2">Password</label>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="form-control-submit-button" style="width: 40%;" >Log In</button>
                                    
                                </div>
                            </form>
                            <!-- end of log in form -->

                        </div> <!-- end of text-box -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of ex-form-1 -->
        <!-- end of form -->


      
            
        <!-- Scripts -->
        <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
        <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
        <script src="js/scripts.js"></script> <!-- Custom scripts -->


        <script>
        // Function to fetch countries from the REST API
        function fetchCountries() {
            // Replace with the actual API endpoint
            const apiUrl = 'https://restcountries.com/v3.1/all';

            // Fetch data from the API
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => populateCountries(data))
                .catch(error => console.error('Error fetching countries:', error));
        }

        // Function to populate the dropdown with countries
        function populateCountries(countries) {
            const selectElement = document.getElementById('countrySelect');

            // Loop through the countries and create option elements
            countries.forEach(country => {
                const option = document.createElement('option');
                option.value = country.name.common; // You can use any property you need
                option.textContent = country.name.common;
                selectElement.appendChild(option);
            });
        }

        // Call the fetchCountries function to populate the dropdown
        fetchCountries();
    </script>

    </body>
</html>