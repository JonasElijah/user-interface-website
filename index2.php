<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

if(isset($_POST['login'])){
		echo '<div class ="col-md-6 offset-md-3 form">';
		if($_POST['login']=='login'){
			$errStatus=array();
			
			$email=$_POST['email'];
			$pWord=$_POST['password'];
			
			
			
			
			if ($email==NULL)
			{
				$errStatus[] .="email=emailNull";
			}
			elseif (!preg_match('/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$email))
			{
				$errStatus[] .="email=emailInvalid";
			}
			
			$_SESSION['email']=$email;

			if ($pWord==NULL)
			{
				$errStatus[] .="password=pWordNull";
			}
			
			$_SESSION['password']=$pWord;
			

			
			include("functions.php");
			if (count($errStatus)>0)
			{
				$errString=implode("&",$errStatus);
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/login.php?$errString");
			}
			
			$dblink = db_connect("UI-schema");
			
			$email = addslashes($email);
			$pWord = addslashes($pWord);

			
			
			$sql = "SELECT `pWord`,`email`,`userID` FROM `user` where `email` LIKE '$email'";
			$result = mysqli_query($dblink, $sql);
			$row = $result->fetch_assoc();
			if($row <0)
			{
			
			redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/login.php?email=emailNonexist");
			}
			else
			{
			
			
				if($row['pWord'] != $pWord)
				{
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/login.php?password=pWordNonexist");
				}
				else
				{

			
				$_SESSION['userID'] = $row['userID'];
				//echo '$_SESSION[\'userID\'] = ' . $_SESSION['userID'] . '<br>';
			
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com");
				}
			}
		}
		
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Photography Website</title>
    <!-- Local Bootstrap CSS files -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
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
                        echo '<button type="button" data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-link end">Login-Modal</button>';
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
			echo '<li class="nav-item"> ';
                        echo ' <a class="nav-link" href="logout.php">Logout</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
   <body>
	<div class="category">
	    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
	        <?php
	        include("functions.php");
	        $dblink = db_connect("UI-schema");
		$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
		
		if ($userID !== null) {
		    $sql = "SELECT `image`.*, IF(`cart`.`imageID` IS NULL, 0, 1) AS `isInCart`
		            FROM `image`
		            LEFT JOIN (SELECT * FROM `orders` WHERE `userID` = '" . mysqli_real_escape_string($dblink, $userID) . "') AS `cart`
		            ON `image`.`ID` = `cart`.`imageID`";
		} else {
		    $sql = "SELECT `image`.*, 0 AS `isInCart`
		            FROM `image`";
		}
	        $result = mysqli_query($dblink, $sql);
		
	        if (mysqli_num_rows($result) == 0) {
	            echo 'Error, database table not found';
	        } else {
	            $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
	            $categories = [
	                'Recommended' => function ($img) {
	                    return $img['category'] !== 'portrait';
	                },
	                'Portrait' => function ($img) {
	                    return $img['category'] === 'portrait';
	                }
	            ];
	
	           function createCarouselItems($imageSets, $categoryName) {
			    $carouselId = "carousel" . preg_replace('/\s+/', '', $categoryName);
			    echo '<h2>' . htmlspecialchars($categoryName) . '</h2><hr>
			          <div id="' . $carouselId . '" class="carousel slide" data-bs-ride="carousel">
			          <div class="carousel-inner">';
			
			    $first = true;
			    foreach ($imageSets as $set) {
			        $activeClass = $first ? 'active' : '';
			        echo '<div class="carousel-item ' . $activeClass . '">
			                <div class="row">';
			        foreach ($set as $image) {
			            $imageID = $image['ID'];
			            $imageName = $image['name'];
			            $imagePrice = $image['price'];
			            $imagePath = $image['image'];
			            $isInCart = $image['isInCart'];
			            $buttonText = $isInCart ? 'In Cart' : 'Add to Cart';
			            $buttonDisabled = $isInCart ? 'disabled' : '';
			            echo '<div class="col-md-2">
			                      <div class="card mb-3" onclick="window.location.href=\'view-item.php?itemID=' . $imageID . '\'">
			                          <img src="' . htmlspecialchars($imagePath) . '" class="card-img-top" alt="Image of ' . htmlspecialchars($imageName) . '" title="' . htmlspecialchars($imageName) . '">
				                  <div class="card-body">
				    		  	<h5 class="card-title">' . $imageName . '</h5>
	                                    	  	<p class="card-text">$' . $imagePrice . '</p>
			                          	<form method="post" action="">
								<input type="hidden" name="imageID" value="' . $imageID . '"> 
						        	<input type="hidden" name="imageName" value="' . $imageName . '"> 
				                  		<input type="hidden" name="imagePrice" value="' . $imagePrice . '"> 
			                              		<button class="add-to-cart-btn" type="submit" name="submit" ' . $buttonDisabled . '>Add to cart</button>
			                          	</form>
				     		 </div>
			                      </div>
			                  </div>';
			        }
			        echo '</div></div>';
			        $first = false;
			    }
			    echo '</div>
			          <button class="carousel-control-prev" type="button" data-bs-target="#' . $carouselId . '" data-bs-slide="prev">
			              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			              <span class="visually-hidden">Previous</span>
			          </button>
			          <button class="carousel-control-next" type="button" data-bs-target="#' . $carouselId . '" data-bs-slide="next">
			              <span class="carousel-control-next-icon" aria-hidden="true"></span>
			              <span class="visually-hidden">Next</span>
			          </button>
			          </div>';
			}
	
	
	            foreach ($categories as $categoryName => $filter) {
	                $filteredImages = array_filter($images, $filter);
	                $imageSets = array_chunk($filteredImages, 5);
	                echo '<div id="carouselExample">';
	                createCarouselItems($imageSets, $categoryName);
	                echo '</div>';
			echo '<br/>';
	            }
	        }
	
	        if (isset($_POST['submit'])) {
		    $imageID = $_POST['imageID'];
		    $imageName = $_POST['imageName'];
		    $imagePrice = $_POST['imagePrice'];
		
		    // Echo for debugging: Outputting values to verify what's being received
		    echo "Debugging Information:<br/>";
		    echo "User ID: " . htmlspecialchars($userID) . "<br/>";
		    echo "Image ID: " . htmlspecialchars($imageID) . "<br/>";
		    echo "Image Name: " . htmlspecialchars($imageName) . "<br/>";
		    echo "Image Price: " . htmlspecialchars($imagePrice) . "<br/>";
		
		    // Prepare the SQL query
		    $sql = "INSERT INTO `orders` (`userID`, `imageID`, `name`, `price`) 
		            VALUES ('$userID', '$imageID', '$imageName', '$imagePrice')";
		    
		    // Execute the query and check for errors
		    if (!$dblink->query($sql)) {
		        echo "Something went wrong with the SQL query: <br/>" . htmlspecialchars($sql) . "<br/>Error: " . $dblink->error;
		        exit; // Stop further execution in case of error
		    } else {
		        // If everything is fine, redirect
		        redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/cart.php");
		    }
		}
	        ?>
	    </div>
	</div>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loginForm" method="post" action="">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                        <p id="emailStatus"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                        <p id="passwordStatus"></p>
                    </div>
                    <button type="submit" name="login" class="btn btn-success">Log In</button>
                </form>
            </div>
        </div>
    </div>
</div>
    </body>
<br/>
<br/>
<br/>
<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">Photography Website &copy; 2024</span>
    </div>
</footer>
<script>
    $(document).ready(function() {
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('email')) {
            var emailError = urlParams.get('email');
            if (emailError == 'emailNull') {
                $('#emailStatus').text('Email cannot be blank!').addClass('alert alert-danger');
            } else if (emailError == 'emailInvalid') {
                $('#emailStatus').text('Email is invalid!').addClass('alert alert-danger');
            } else if (emailError == 'emailNonexist') {
                $('#emailStatus').text('Email does not exist!').addClass('alert alert-danger');
            }
        }

        if (urlParams.has('password')) {
            var passwordError = urlParams.get('password');
            if (passwordError == 'pWordNull') {
                $('#passwordStatus').text('Password cannot be blank!').addClass('alert alert-danger');
            } else if (passwordError == 'pWordNonexist') {
                $('#passwordStatus').text('Password does not match email!').addClass('alert alert-danger');
            }
        }
    });
</script>
<!-- Local Bootstrap JavaScript files -->
<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</html>
