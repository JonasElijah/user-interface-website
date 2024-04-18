<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photography Website</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
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
        /* Carousel and card styling adjustments */
        #carouselExample .carousel-item .col-md {
            flex: 0 0 auto;
            width: 20%;
        }

        #carouselExample .carousel-item img {
            height: auto;
            max-height: 200px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            #carouselExample .carousel-item .col-md {
                width: 33.33%;
            }
        }

        @media (max-width: 480px) {
            #carouselExample .carousel-item .col-md {
                width: 50%;
            }
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
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
<main>
    <div class="container mt-4">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                include("functions.php");
                $dblink = db_connect("UI-schema"); // Make sure to have a function db_connect returning a connection object
                $sql = "SELECT * FROM `image`";
                $result = mysqli_query($dblink, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $imageSets = array_chunk($images, 5);
                    $first = true;

                    foreach ($imageSets as $set) {
                        echo '<div class="carousel-item ' . ($first ? 'active' : '') . '">';
                        echo '<div class="row g-0">';

                        foreach ($set as $image) {
			    $imagePath = $image['image'];
		            $imageName = $image['name'];
		            $imagePrice = $image['price'];
		            $imageID = $image['ID'];  

                            echo '<div class="col-md">';
                            echo '<div class="card">';
                            echo '<img src="'.$image['image'].'" class="card-img-top" alt="'.$image['name'].'">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">'.$image['name'].'</h5>';
                            echo '<p class="card-text">Price: '.$image['price'].'</p>';
			    <form method="post" action="">
                  	    <input type="hidden" name="imageID" value="'.$imageID.'"> 
		            <input type="hidden" name="imageName" value="'.$imageName.'"> 
                  	    <input type="hidden" name="imagePrice" value="'.$imagePrice.'"> 
			    <button type="submit" name="submit">Add to Cart</button>
			    </form>
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }

                        echo '</div>';
                        echo '</div>';
                        $first = false;
                    }
                } else {
                    echo '<p class="text-center">No images found in the database.</p>';
                }

		if (isset($_POST['submit'])) {
		    $imageID = $_POST['imageID'];
		    $imageName = $_POST['imageName'];
		    $imagePrice = $_POST['imagePrice'];
		
		    echo "Image ID: " . $imageID . "<br>";
		    echo "Image Name: " . $imageName . "<br>";
		    echo "Image Price: " . $imagePrice . "<br>";
		
		    $userID = $_SESSION['userID'];
		    
		    $sql = "INSERT INTO `orders` (`userID`, `imageID`, `name`, `price`) 
		            VALUES ('$userID', '$imageID', '$imageName', '$imagePrice')";
		    $dblink->query($sql) or
		    die("Something went wrong with: <br>$sql<br>" . $dblink->error . "</p>");
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
</main>
<footer class="bg-light text-center text-lg-start mt-4">
    <div class="text-center p-3">
        &copy; 2024 Photography Website
    </div>
</footer>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
