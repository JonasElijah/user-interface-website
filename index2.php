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


	#carouselExample .carousel-item img {
	  height: 300px; /* Reduced height */
	  width: auto; /* Auto width to maintain aspect ratio */
	  object-fit: cover; /* Cover the area nicely without stretching the image */
	}
	
	.carousel-item .row {
	display: flex;
	justify-content: center; /* Centers the columns horizontally */
	}
	
	.carousel-item .col-md-2 {
	flex: 0 0 auto; /* Flex grow, shrink, and basis */
	width: 18%; /* Adjust width to slightly less than 1/5th to include margins */
	padding: 5px; /* Padding for spacing between cards */
	}
	
	.card {
	margin: 10px auto; /* Margin for top and bottom spacing and auto to center horizontally */
	width: 100%; /* Make the card use all available width within the column */
	box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Optional: Adds shadow for better visibility */
	}
	
	/* Ensure the images fit well within the cards */
	.card-img-top {
	width: 100%;
	height: auto; /* Maintain aspect ratio */
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
<div class="category">
  <h1>Recommended</h1>
  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php
      include("functions.php");
      $dblink = db_connect("UI-schema");
      $sql = "SELECT * FROM `image`";
      $result = mysqli_query($dblink, $sql);

      if (mysqli_num_rows($result) == 0) {
          echo 'Error, database table not found';
      } else {
          $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
          $imageSets = array_chunk($images, 5);
          $first = true;
          foreach ($imageSets as $set) {
              $activeClass = $first ? 'active' : '';
              echo '<div class="carousel-item '.$activeClass.'"><div class="row">';
              foreach ($set as $image) {
                  echo '<div class="col-md-2">
                          <div class="card">
                            <img src="'.$image['image'].'" class="card-img-top" alt="Image of '.$image['name'].'">
                            <div class="card-body">
                              <h5 class="card-title">'.$image['name'].'</h5>
                              <p class="card-text">'.$image['price'].'</p>
                              <form method="post" action="">
                                <input type="hidden" name="imageID" value="'.$image['ID'].'">
                                <input type="hidden" name="imageName" value="'.$image['name'].'">
                                <input type="hidden" name="imagePrice" value="'.$image['price'].'">
                                <button type="submit" name="submit">Add to Cart</button>
                              </form>
                            </div>
                          </div>
                        </div>';
              }
              echo '</div></div>';
              $first = false;
          }
      }
      ?>
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


