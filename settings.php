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
			position: absolute;
			bottom: 0;
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
			position: fixed;
			height: 100%;
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
			height: 100%;
			position: fixed;
			width: 100%;
			margin: unset;
		}
	    @media (max-width: 480px) {
	    .photo-row img {
                margin: 0.5px;
                max-width: 90px;
            }
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
    <header>
    <nav class="navbar navbar-expand-lg custom-navbar shadow rounded">
        <div class="container-fluid">
	<a href="index.php">
	    <img class="site-logo" src="assets/images/photography.png" alt="Photography Logo" style="max-width: 250px; max-height: 100px"/>
	</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
			
			
			echo '<div class="offset-md-1">';
				
					
						echo '<a class="nav-link active" href="account.php">General</a>';
					
						echo '<a class="nav-link" href="#">Accessibility</a>';
				
						echo '<a class="nav-link" href="#">Account</a>';
					
						echo '<a class="nav-link" href="gallery.php">Privacy & Security</a>';
					
			echo '</div>';
		echo '</div>';
		echo '</div>';
		
		//Profile info
		echo '<div class="col-md-9 offset-md-3">';
		echo '<div class="col-md-10 offset-md-1">';
		
		echo '<h1>Settings</h1>';
		echo '<hr>';
	?>
   <br />
    <br />
    <br />
		
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
