<?php
	include("functions.php");
	
	if (session_status() === PHP_SESSION_NONE) {
    	session_start();
	}
	
	if(!isset($_SESSION['userID'])){
		redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/login.php");
	}
	else {
		$userId = $_SESSION['userID'];
		$dblink=db_connect("UI-schema");
		$sql="SELECT * FROM `user` where `userID` LIKE '$userId'";
		$result=$dblink->query($sql) or
			die("<p>Something went wrong with: <br>$sql<br>".$dblink->error."</p>");
		$data=$result->fetch_array(MYSQLI_ASSOC);
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


      body {
        font-family: "Georgia", sans-serif;
      }
		
		footer {
			/*position: absolute;
			bottom: 0;*/
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
		
		.profile-img {
			border-radius: 50%;
			width: 100px;
			height: 100px;
			border-style: solid;
			margin: 20px;
			background-color: white;
		 }
		
		.sidebar {
	  		background-color: #F2EAE1;
			border-right: thin;
			border-right-style: solid;
			border-color: #b7b7b7;
			height: inherit;
			overflow: auto;
		}
		
		.sidebar a {
			color:dimgray;
			text-decoration: underline;
		}
		
		.sidebar a:hover {
			color: black;
			text-decoration: none;
		}
		
		.active {
			color: black;
		}
		
		.sub-text {
			color: dimgray;
			font-style: italic;
		}
		
		.user-info {
			border-radius: 5px;
			padding: 10px;
			background-color: white;
			font-style: normal;
		}
		
		.main-background {
			background-color: whitesmoke;
			min-height: 79vh;
			width: 100%;
			margin: unset;
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
               	 	echo ' <a class="nav-link" href="#">Login</a>';
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

    <div>
	<?php
		echo "<div class='row main-background'>";
		//Side Bar
		echo '<div class="col-md-3 sidebar" >';
			echo '<div class="col-md-10 offset-md-1">';
			echo '<div align="center">';
			echo '<img src="assets/images/photography.png" class="profile-img">';
			echo '</div>';
			echo '<div align="center">';
				echo '<h5>'.$data['fName'].' '.$data['lName'].'</h5>';
			echo '</div>';
			echo '<hr>';
			echo '<div class="offset-md-1">';
				echo '<ul class="nav flex-column">';
					echo '<li class="nav-item">';
						echo '<a class="nav-link active" href="account.php">Profile</a>';
					echo '</li>';
					echo '<li class="nav-item">';
						echo '<a class="nav-link" href="#">Payment Options</a>';
					echo '</li>';
					echo '<li class="nav-item">';
						echo '<a class="nav-link" href="#">Biography</a>';
					echo '</li>';
					echo '<li class="nav-item">';
						echo '<a class="nav-link" href="gallery.php">View Gallery</a>';
					echo '</li>';
				echo '</ul>';
			echo '</div>';
		echo '</div>';
		echo '</div>';
		
		//Profile info
		echo '<div class="col-md-9">';
		echo '<div class="col-md-10 offset-md-1">';
		echo '<br>';
		echo '<h1>Profile</h1>';
			echo '<div class="sub-text offset-md-1">';
				echo '<br>';
				echo '<h3>First Name</h3>';
				echo '<p class="user-info">'.$data['fName'].'</p>';
				echo '<br>';
				echo '<h3>Last Name</h3>';
				echo '<p class="user-info">'.$data['lName'].'</p>';
				echo '<br>';
				echo '<h3>Email</h3>';
				echo '<p class="user-info">'.$data['email'].'</p>';
				echo '<br>';
			echo '</div>';
		echo '</div>';
		echo '</div>';
		
		echo '</div>';
	?>
	
	<footer class="footer col-md-12 mt-auto py-3 bg-light">
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

