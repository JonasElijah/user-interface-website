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
            padding: 15px;
        }

        .photo-row img {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin-right: 10px;
            width: 100%; /* Ensures responsiveness */
        }

        .category {
            margin-bottom: 10px;
            padding: 20px;
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
            height: 300px;
            width: auto;
            object-fit: cover;
        }

        .carousel-item .row {
            display: flex;
            justify-content: center;
        }

        .carousel-item .col-md-2 {
            flex: 0 0 auto;
            width: 18%;
            padding: 3px;
        }

        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
            cursor: pointer;
            margin: 10px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            transition: transform 0.5s ease;
            display: block;
            width: 100%;
            height: auto;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
            z-index: 10;
        }

        .carousel-inner .row {
            display: flex;
            overflow: hidden;
        }

        .carousel-item .col-md-2 {
            transition: margin 0.3s ease-in-out;
        }

        .carousel-item .col-md-2:hover {
            margin: 0 5px;
        }

        #carouselExample {
            max-width: 100%;
            position: relative;
            padding: 0 10px;
        }

        .carousel-control-next-icon {
            background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 8 8"><path d="M3.293 0l-1 1L5.293 4 2.293 7l1 1L8 4 3.293 0z"/></svg>');
            background-color: transparent;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-control-prev-icon {
            background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 8 8"><path d="M4.707 0l1 1L2.707 4l3 3-1 1L0 4l4.707-4z"/></svg>');
            background-color: transparent;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #carouselExample .carousel-control-prev,
        #carouselExample .carousel-control-next {
            filter: drop-shadow(0 0 5px rgba(0, 0, 0, 0.5));
        }

        #carouselExample .carousel-control-prev {
            left: -80px;
        }

        #carouselExample .carousel-control-next {
            right: -80px;
        }
	

	@media (max-width: 480px) {
	    #carouselExample .carousel-control-prev,
	    #carouselExample .carousel-control-next {
	        display: none;  /* Optionally hide controls on small devices */
	    }
	
	    .carousel-item .col-md-2 {
	        flex: 0 0 100%; /* Each item takes full width of the carousel */
	        max-width: 100%; /* Each item takes full width of the carousel */
	        padding: 3px; /* Adjust padding as needed */
	    }
	
	    .carousel-inner .row {
	        flex-wrap: nowrap; /* Prevents wrapping of items */
	        overflow-x: auto; /* Allows horizontal scrolling */
	        scroll-snap-type: x mandatory; /* Optional: enhances the scroll experience */
	    }
	
	    .carousel-item .col-md-2 {
	        scroll-snap-align: start; /* Optional: ensures items align nicely on scroll */
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


        .add-to-cart-btn {
            background-color: #fdf4eb;
            color: #333;
            border: 1px solid #a5998c;
            padding: 4px 8px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            outline: none;
        }

        .add-to-cart-btn:hover {
            background-color: #f0e6d1;
        }

        .add-to-cart-btn:focus {
            border-color: #555;
            outline: none;
        }
    </style>

</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg custom-navbar shadow rounded">
        <div class="container-fluid">
            <img src="assets/images/photography.png" alt="Photography Logo" style="max-width: 250px; max-height: 100px"/>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#myModal" class="nav-link">Upload</button>
                    </li>
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

