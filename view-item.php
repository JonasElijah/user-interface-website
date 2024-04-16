<?php
	include("functions.php");
	
	if (session_status() === PHP_SESSION_NONE) {
    	session_start();
	}
	
	//Debug
	$_GET['itemID'] = 81;
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
		
		footer {
			margin-top: 20px;
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
		
		.product-image {
			width:inherit;
			height: auto;
		}
		
		.main-view {
			min-height: 79vh;
			width: 100%;
		}
		
		.info {
			height: 70%;
			overflow: auto;
		}
		
		.price-val {
			text-align: right;
		}
		
		.desc {
			height: 60%;
			overflow:auto;
		}
		
		.item {
			display: flex;
			justify-content: center;
			align-items: center;
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
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="gallery.php">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
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
		$imageId = $_SESSION['itemID'];
		$dblink=db_connect("UI-schema");
		$sql="SELECT * FROM `image` where `ID` LIKE '$imageId'";
		$result=$dblink->query($sql) or
			die("<p>Something went wrong with: <br>$sql<br>".$dblink->error."</p>");
		$data=$result->fetch_array(MYSQLI_ASSOC);
	  
	  	if(!isset($_POST['submit']))
		{
			echo '<div class="row main-view">';
				//Display Image
				echo '<div class="col-md-6 item">';
				echo '<img src="'.$data['image'].'" class="img-fluid">';
				echo '</div>';

				//Description
				echo '<div class="col-md-6">';
				echo '<br><hr>';
				echo '<p>Description of the photo</p>';
				echo '<p class="desc">"'.$data['ds'].'"</p>';
					echo '<div>';
					echo '<hr><br>';
						echo '<div class="row">';
						echo '<h5 class="col-md-2 offset-md-5">Price:</h5>';
						echo '<h5 class="col-md-4 price-val">$'.$data['price'].'</h5>';
						echo '</div>';
					echo '</div>';
					echo '<br><br><br>';
					echo '<div class="col-md-3 offset-md-8" align="right">';
						echo '<form method="post" action="">';
						echo '<button type="button" class="btn btn-outline-secondary" name="submit" type="submit" value="submit">Add to Cart</button>';
						echo '</form>';
					echo '</div>';
				echo '</div>';

			echo '</div>';
		}
	  	if(isset($_POST['submit']))
		{	
			echo '<div class="row main-view">';
				//Display Image
				echo '<div class="col-md-6 item">';
				echo '<img src="'.$data['image'].'" class="img-fluid">';
				echo '</div>';

				//Description
				echo '<div class="col-md-6">';
				echo '<br><hr>';
				echo '<p>Description of the photo</p>';
				echo '<p class="desc">"'.$data['ds'].'"</p>';
					echo '<div>';
					echo '<hr><br>';
						echo '<div class="row">';
						echo '<h5 class="col-md-2 offset-md-5">Price:</h5>';
						echo '<h5 class="col-md-4 price-val">$'.$data['price'].'</h5>';
						echo '</div>';
					echo '</div>';
					echo '<br><br><br>';
					echo '<div class="col-md-3 offset-md-8" align="right">';
						echo '<form method="post" action="">';
						echo '<button type="button" class="btn btn-outline-secondary" name="submit" type="submit" value="submit">Add to Cart</button>';
						echo '</form>';
					echo '</div>';
				echo '</div>';

			echo '</div>';
			
			if(!isset($_SESSION['userID']))
			{
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/login.php");
			}
			
			$userID = $_SESSION['userID'];
			$imageID = $_GET['itemID'];
			$name = $data['name'];
			$price = $data['price'];
			$sql="Insert into `orders` (`userID`,`imageID`,`name`,`price`) values ('$userID,'$imageID','$name','$price')";
			$dblink->query($sql) or
				die("Something went wrong with: $sql<br>".$dblink->error."</p>");
			
			echo '<div aria-live="polite" aria-atomic="true" class="position-relative">
			  <div class="toast-container top-0 end-0 p-3">

				<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
				  <div class="toast-header">
					<img src="assets/assets/images/photography.png" class="rounded me-2" alt="...">
					<strong class="me-auto">Photography Website</strong>
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				  </div>
				  <div class="toast-body">
					Succesfully Added Item to Cart!
				  </div>
				</div>';
		}
	?>

   <br />
    <br />
    <br />
	
	<div class="row">
    <footer class="footer mt-auto py-3 bg-light">
      <div class="container text-center">
        <span class="text-muted">Photography Website &copy; 2024</span>
      </div>
    </footer>
	</div>
		
    <!-- Local Bootstrap JavaScript files -->
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>