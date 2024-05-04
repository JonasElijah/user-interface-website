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

	    @media (max-width: 480px) {
	    .custom-navbar {
	        flex-direction: column;
	        align-items: flex-start;
	    }
	
	    .navbar-nav {
	        width: 100%;
	        justify-content: flex-start;
	    }
	
	    .nav-item {
	        padding: 5px 0; /* More vertical padding on mobile */
	    }

	    .navbar-expand-lg .navbar-collapse {
	        flex-basis: 100%; /* Full width for the collapsible area */
	        flex-grow: 1;
	    }
	
	    .navbar-toggler {
	        display: block; /* Ensure toggler is always visible below this breakpoint */
	    }
		
	    .custom-navbar .navbar-brand img {
	        max-width: 150px; /* Even smaller logo for very small screens */
	    }
	
	    .navbar-nav .nav-link {
	        font-size: 12px; /* Even smaller font size */
	    }
	}
    </style>
  </head>
  <body>
    <div id="header">
        <?php include 'header.html'; ?>
    </div>

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
