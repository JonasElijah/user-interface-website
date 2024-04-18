	<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
	    ?>
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
	    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease; /* Smooth transition for transformation and shadow */
	    cursor: pointer; /* Indicates that the card is clickable */
	    margin: 10px auto; /* Centering and spacing */
	    box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Initial subtle shadow for depth */
	  }
	
	/* Ensure the images fit well within the cards */
	.card-img-top {
	    transition: transform 0.5s ease; /* Smooth transition using transform over 0.5 seconds */
	    display: block; /* Ensures the image takes up the full container width */
	    width: 100%; /* Maintains full width */
	    height: auto; /* Keeps aspect ratio */
	  }
	
	  .card:hover {
	    transform: scale(1.05); /* Slightly enlarges the card */
	    box-shadow: 0 8px 16px rgba(0,0,0,0.4); /* Enhances shadow for a lifted effect */
	    z-index: 10; /* Ensures the card pops out over other content */
	  }

	    .carousel-inner .row {
	    display: flex; /* Ensures that cards are in a flex container */
	    overflow: hidden; /* Prevents the row from spilling out of its container */
	  }
	
	  /* Specific adjustments to prevent cards from pushing others around on scale */
	  .carousel-item .col-md-2 {
	    transition: margin 0.3s ease-in-out; /* Smooth transition for margins */
	  }
	
	  .carousel-item .col-md-2:hover {
	    margin: 0 5px; /* Optional: Adjust margins if needed to prevent overlap */
	  }
	    
	#carouselExample {
	    max-width: 100%; /* Limit carousel width to prevent overflow */
	    position: relative; /* Needed for absolute positioning of children */
	    padding: 0 50px; /* Adjust this value to increase space for buttons */
	  }
	
	  /* CSS for customizing the carousel control icons */
	  .carousel-control-next-icon {
	    background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 8 8"><path d="M3.293 0l-1 1L5.293 4 2.293 7l1 1L8 4 3.293 0z"/></svg>'); /* SVG with black arrow pointing left */
	    background-color: transparent; /* Transparent background */
	    border-radius: 50%; /* Round shape */
	    width: 40px; /* Standard size */
	    height: 40px; /* Standard size */
	    display: flex; /* Enables centering of the icon */
	    align-items: center; /* Center vertically */
	    justify-content: center; /* Center horizontally */
	  }
	
	  .carousel-control-prev-icon {
	    background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 8 8"><path d="M4.707 0l1 1L2.707 4l3 3-1 1L0 4l4.707-4z"/></svg>'); /* SVG with black arrow pointing right */
	    background-color: transparent; /* Transparent background */
	    border-radius: 50%; /* Round shape */
	    width: 40px; /* Standard size */
	    height: 40px; /* Standard size */
	    display: flex; /* Enables centering of the icon */
	    align-items: center; /* Center vertically */
	    justify-content: center; /* Center horizontally */
	  }

	
	  /* Make sure the controls are visible against any background */
	  #carouselExample .carousel-control-prev,
	  #carouselExample .carousel-control-next {
	    filter: drop-shadow(0 0 5px rgba(0,0,0,0.5)); /* Soft shadow for better visibility */
	  }
	
	  #carouselExample .carousel-control-prev {
	    left: -30px; /* Place outside the carousel padding area */
	  }
	
	  #carouselExample .carousel-control-next {
	    right: -30px; /* Place outside the carousel padding area */
	  }
	
	  /* Adjust button visibility on smaller screens if necessary */
	  @media (max-width: 768px) {
	    #carouselExample {
	      padding: 0 30px; /* Smaller padding on smaller screens */
	    }
	    #carouselExample .carousel-control-prev {
	      left: -20px;
	    }
	    #carouselExample .carousel-control-next {
	      right: -20px;
	    }
	  }

	  /* Custom styling for the 'Add to Cart' button */
	  .add-to-cart-btn {
	    background-color: #fdf4eb; /* Light cream background */
	    color: #333; /* Dark text for contrast */
	    border: 1px solid #a5998c; /* Thinner, subtle border */
	    padding: 4px 8px; /* Appropriate padding for a better click area */
	    transition: background-color 0.3s ease; /* Smooth transition for hover effects */
	    cursor: pointer; /* Cursor indicates clickable button */
	    outline: none; /* Removes the default focus outline */
	  }
	
	  /* Hover effect to subtly change color for user feedback */
	  .add-to-cart-btn:hover {
	    background-color: #f0e6d1; /* Slightly darker shade on hover for interaction feedback */
	  }
	
	  /* Focus state to maintain accessibility */
	  .add-to-cart-btn:focus {
	    border-color: #555; /* Darkens the border to indicate focus */
	    outline: none; /* Keeps the focus style clean */
	  }


    </style>
  </head>
  <body>
	
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
  <h2> Recommended </h2>
  <hr>
  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <?php
    include("functions.php");
    $dblink = db_connect("UI-schema");
    $sql = "SELECT * FROM `image`";
    $result = mysqli_query($dblink, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo 'Error, database table not found';
    } else {
        $images = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch all images into an array

        // Split images array into chunks of 5
        $imageSets = array_chunk($images, 5);

        echo '<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">';

        // Loop through the image sets and generate HTML for each carousel item
        $first = true; // Flag to mark the first item as active
        foreach ($imageSets as $set) {
            $activeClass = $first ? 'active' : ''; // Add 'active' class to the first item

            echo '<div class="carousel-item '.$activeClass.'">
                    <div class="row">'; // Open a row for the set of images

            // Loop through the images in the set and generate HTML for each image
            foreach ($set as $image) {
                $imagePath = $image['image'];
                $imageName = $image['name'];
                $imagePrice = $image['price'];
                $imageID = $image['ID'];  // Assuming there's an 'id' field in your images table

                echo '<div class="col-md-2">
                        <div class="card mb-3" style="cursor:pointer;" onclick="window.location.href=\'view-item.php?itemID='.$imageID.'\'">
                          <img src="'.$imagePath.'" class="card-img-top" alt="Image of '.$imageName.'" title="Click to view details">
                          <div class="card-body">
                            <h5 class="card-title">'.$imageName.'</h5>
                            <p class="card-text">'.$imagePrice.'</p>
                            <form method="post" action="">
                              <input type="hidden" name="imageID" value="'.$imageID.'"> 
                              <input type="hidden" name="imageName" value="'.$imageName.'"> 
                              <input type="hidden" name="imagePrice" value="'.$imagePrice.'"> 
				<button type="submit" name="submit" class="add-to-cart-btn">Add to Cart</button>
                            </form>
                          </div>
                        </div>
                      </div>';
            }

            echo '</div></div>'; // Close the row and carousel item

            $first = false; // Update the flag after the first iteration
        }

       echo '</div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>';
    }

    if (isset($_POST['submit'])) {
    $imageID = $_POST['imageID'];
    $imageName = $_POST['imageName'];
    $imagePrice = $_POST['imagePrice'];

    $userID = $_SESSION['userID'];
    
    $sql = "INSERT INTO `orders` (`userID`, `imageID`, `name`, `price`) 
            VALUES ('$userID', '$imageID', '$imageName', '$imagePrice')";
    $dblink->query($sql) or
    die("Something went wrong with: <br>$sql<br>" . $dblink->error . "</p>");
}


    ?>
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
