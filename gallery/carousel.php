<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Photography Website</title>
    <!-- Local Bootstrap CSS files -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      
        header {
          background-color: #fdf4eb;
        }

      .custom-navbar h1 {
        margin: 0;
        padding: 0; 
        line-height: 1;
        vertical-align: bottom; 
         font-size: 25px;
      }
      body {
        font-family: "Georgia", sans-serif;
      }

      .dropdown-menu {
        display: none;
      }

      #hover-dropdown:hover .dropdown-menu {
        display: block;
        min-width: 1rem;
        max-width: 6.5rem;
        max-height: calc(50vh - 50px);
        overflow-y: auto;
        text-align: center;
      }

      .photo-row {
        padding: 50px;
      }

      .photo-row img {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-right: 20px;
      }

      .category {
        margin-bottom: 10px;
        padding: 40px;
        margin-right: 10px;
      }

      .custom-button {
        background-color: #fdf4eb;
        border-color: #fdf4eb;
        color: #a5998c;
      }

      .custom-button:hover {
        background-color: #f0e6d1;
        border-color: #f0e6d1;
        color: #a5998c;
      }


  #carouselExample {
    max-width: 600px; 
    margin: 0 auto; 
  }


  #carouselExample .carousel-item img {
    height: 300px; 
    object-fit: cover; 
  }
    </style>
  </head>
  <body>
	<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
	    ?>
    <header>
      <nav
        class="navbar navbar-expand-lg custom-navbar shadow rounded"
      >
        <div class="container-fluid">
          <img
            src="assets/images/photography.png"
            alt="Photography Logo"
            style="max-width: 250px; max-height: 100px"
          />

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
           <h1 class="text-center">Photography Website</h1>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="gallery.php">Gallery</a>
              </li>
           
              <?php

	if(!isset($_SESSION['userID'])){
			echo '<li class="nav-item"> ';
               	 	echo ' <a class="nav-link" href="login.php">Login</a>';
              		echo '</li>';
              		echo '<li class="nav-item">';
                	echo '<a class="nav-link" href="signup.php">Signup</a>';
              		echo ' </li>';
			}
	else{
			echo '<li class="nav-item">';
                	echo '<a class="nav-link" href="cart.php">Cart</a>';
             		echo '</li>';		
			echo '<li class="nav-item">';
                	echo '<a class="nav-link" href="account.php">Account</a>';
             		echo '</li>';
			    }
		?>

              <!--
              <li class="nav-item dropdown" id="hover-dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  aria-haspopup="true"
                  aria-expanded="false"
                  >Profile</a
                >
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Account</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li><a class="dropdown-item" href="#">Cart</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                </ul>
              </li>
              -->
            </ul>
          </div>
        </div>
      </nav>
    </header>
    
<?php

include("functions.php");
$dblink = db_connect("UI-schema");
$sql = "SELECT * FROM `image`";
$result = mysqli_query($dblink, $sql);
if(mysqli_num_rows($result) == 0)
		{
			echo 'Error, database table not found';
		}
else
		{	
			echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">';
					    echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
					    echo '<span class="visually-hidden">Previous</span>';
					  echo '</button>';
						echo '<div>';
					        echo '<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">';
					  	echo '<div class="carousel-inner">';
					    	echo '<div class="carousel-item active">';
						echo '<a href';
					      echo ' <img src="assets/images/photography.png" alt="Photography Logo" style="max-width: 250px; max-height: 100px/>';
					    echo '</div>';
					  echo '</div>';
					
					   echo '<button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">';
					   echo ' <span class="carousel-control-next-icon" aria-hidden="true"></span>';
					   echo ' <span class="visually-hidden">Next</span>';
					   echo '  </button>';
					   echo '</div>';
		}


?>

	<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="#">
                <img src="assets/images/photography.png" alt="Photography Logo" style="max-width: 250px; max-height: 100px;"/>
            </a>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

   <br />
    <br />
    <br />

    <footer class="footer mt-auto py-3 bg-light">
      <div class="container text-center">
        <span class="text-muted">Photography Website &copy; 2024</span>
      </div>
    </footer>

    <!-- Local Bootstrap JavaScript files -->
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>

<!--
      <section class="category">
        <h2>Recommended</h2>
        <div class="photo-row">
          <img
            src="assets/images/gallery/DSC00892.jpg"
            alt="Your Logo"
            style="max-width: 350px; max-height: 300px"
          />
          <img
            src="assets/images/gallery/DSC00868-Enhanced-NR.jpg"
            alt="Your Logo"
            style="max-width: 550px; max-height: 250px"
          />
          <img
            src="assets/images/gallery/DSC00022.jpg"
            alt="Your Logo"
            style="max-width: 500px; max-height: 350px"
          />
          <img
            src="assets/images/gallery/DSC00887.jpg"
            alt="Your Logo"
            style="max-width: 300px; max-height: 330px"
          />
        </div>
      </section>

      <section class="category">
        <h2>Nature</h2>
        <div class="photo-row">
          <img
            src="assets/images/gallery/DSC06655.jpg"
            alt="Your Logo"
            style="max-width: 350px; max-height: 300px"
          />
          <img
            src="assets/images/gallery/DSC06664.jpg"
            alt="Your Logo"
            style="max-width: 550px; max-height: 250px"
          />
          <img
            src="assets/images/gallery/DSC07026.jpg"
            alt="Your Logo"
            style="max-width: 500px; max-height: 350px"
          />
          <img
            src="assets/images/gallery/DSC07112.jpg"
            alt="Your Logo"
            style="max-width: 300px; max-height: 230px"
          />
        </div>
      </section>

      <section class="category">
        <h2>Portrait</h2>
        <div class="photo-row">
          <img
            src="assets/images/gallery/DSC07334-Enhanced-NR.jpg"
            alt="Your Logo"
            style="max-width: 450px; max-height: 300px"
          />
          <img
            src="assets/images/gallery/DSC00980.jpg"
            alt="Your Logo"
            style="max-width: 400px; max-height: 250px"
          />
          <img
            src="assets/images/gallery/DSC05084-Enhanced-NR-2.jpg"
            alt="Your Logo"
            style="max-width: 500px; max-height: 350px"
          />
          <img
            src="assets/images/gallery/DSC06474.jpg"
            alt="Your Logo"
            style="max-width: 450px; max-height: 300px"
          />
          <img
            src="assets/images/gallery/DSC04977-Enhanced-NR.jpg"
            alt="Your Logo"
            style="max-width: 550px; max-height: 300px"
          />
        </div>
      </section>
    </div>

    <div
      class="container"
      style="
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10vh;
      "
    >
      <button type="button" class="btn btn-primary btn-lg custom-button">
        Explore More
      </button>
    </div>
-->
