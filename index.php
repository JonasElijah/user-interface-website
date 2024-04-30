<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
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
<div class="category">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <?php
        include("functions.php");
        $dblink = db_connect("UI-schema");
          // $sql = "SELECT image.*, IF(cart.imageID IS NULL, 0, 1) AS isInCart
          //   FROM image
          //   LEFT JOIN (SELECT * FROM orders WHERE userID = ?) AS cart
          //   ON image.ID = cart.imageID";

        $sql = "SELECT *, `category` FROM `image`";

        $result = mysqli_query($dblink, $sql);
        // if (mysqli_num_rows($result) == 0) {
        //     echo 'Error, database table not found';
        // } else {
        //     $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //     $categories = [
        //         'Recommended' => function ($img) {
        //             return $img['category'] !== 'portrait';
        //         },
        //         'Portrait' => function ($img) {
        //             return $img['category'] === 'portrait';
        //         }
        //     ];

            function createCarouselItems($imageSets, $categoryName)
            {
                $carouselId = "carousel" . preg_replace('/\s+/', '', $categoryName);
                echo '<h2>' . $categoryName . '</h2><hr>
                      <div id="' . $carouselId . '" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">';
                $first = true;
                 foreach ($images as $image) {
		        $imageID = $image['ID'];
		        $imageName = $image['name'];
		        $imagePrice = $image['price'];
		        $imagePath = $image['image'];
		        $isInCart = $image['isInCart'];
		
		        // Check if the item is already in the cart
		        $buttonText = $isInCart ? 'In Cart' : 'Add to Cart';
		        $buttonDisabled = $isInCart ? 'disabled' : '';
		
		        echo '<div class="col-md-2">
		                  <div class="card mb-3" style="cursor:pointer;" onclick="window.location.href=\'view-item.php?itemID=' . $imageID . '\'">
		                      <img src="' . $imagePath . '" class="card-img-top" alt="Image of ' . $imageName . '" title="Click to view details">
		                      <div class="card-body">
		                          <h5 class="card-title">' . $imageName . '</h5>
		                          <p class="card-text">$' . $imagePrice . '</p>
		                          <form method="post" action="">
		                              <input type="hidden" name="imageID" value="' . $imageID . '"> 
		                              <input type="hidden" name="imageName" value="' . $imageName . '"> 
		                              <input type="hidden" name="imagePrice" value="' . $imagePrice . '"> 
		                              <button class="add-to-cart-btn" type="submit" name="submit" ' . $buttonDisabled . '>' . $buttonText . '</button>
		                          </form>
		                      </div>
		                  </div>
		              </div>';
		    }
                    echo '</div></div>';
                    $first = false;
                }
                echo '</div>';
                echo '
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
                //createCarouselItems($imageSets, $categoryName);
                echo '</div>';
		echo '<br/>';
            }
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
	    redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/cart.php");
        }
        ?>
    </div>
</div>
<br/>
<br/>
<br/>
<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">Photography Website &copy; 2024</span>
    </div>
</footer>
<!-- Local Bootstrap JavaScript files -->
<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</html>
