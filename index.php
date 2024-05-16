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
    <link href="/assets/css/index.css" rel="stylesheet"/>
</head>
<body>
<div id="header">
        <?php include 'assets/html/header.html'; ?>
</div>
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
                    return $img['category'] !== 'Portrait' || $img['category'] !== 'portrait' || $img['category'] !== 'Landscape' || $img['category'] !== 'Wildlife' || $img['category'] !== 'Marco' || $img['category'] !== 'Street' || $img['category'] !== 'Travel' || $img['category'] !== 'Astro';
                },
                'Portrait' => function ($img) {
                    return $img['category'] === 'Portrait' || $img['category'] === 'portrait';
                },
                'Landscape' => function ($img) {
                    return $img['category'] === 'Landscape';
                },
                'Wildlife' => function ($img) {
                    return $img['category'] === 'Wildlife';
                },
                'Macro' => function ($img) {
                    return $img['category'] === 'Macro';
                },
                'Street' => function ($img) {
                    return $img['category'] === 'Street';
                },
                'Travel' => function ($img) {
                    return $img['category'] === 'Travel';
                },
                'Astro' => function ($img) {
                    return $img['category'] === 'Astro';
                },
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
		                      <div class="card mb-3" alt="'.$imageName.' Price $'.$imagePrice.'" onclick="window.location.href=\'/cart/view-item.php?itemID=' . $imageID . '\'">
		                          <img src="' . htmlspecialchars($imagePath) . '" class="card-img-top" alt="Image of ' . htmlspecialchars($imageName) . '" title="' . htmlspecialchars($imageName) . '">
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
                
                if (!empty($imageSets)) 
                {
                    echo '<div id="carouselExample">';
                    createCarouselItems($imageSets, $categoryName);
                    echo '</div>';
                    echo '<br/>';
                }
            }
        }

        if (isset($_POST['submit'])) {
		if($userID == null)
		{
			redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/login.php");
		}

	    $imageID = $_POST['imageID'];
	    $imageName = $_POST['imageName'];
	    $imagePrice = $_POST['imagePrice'];
	
	    $sql = "INSERT INTO `orders` (`userID`, `imageID`, `name`, `price`) 
	            VALUES ('$userID', '$imageID', '$imageName', '$imagePrice')";
	    
	    if (!$dblink->query($sql)) 
        {
	        echo "Something went wrong with the SQL query: <br/>" . htmlspecialchars($sql) . "<br/>Error: " . $dblink->error;
	        exit; 
	    } 
        else 
        {
	        redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/cart/cart.php");
	    }
	}

        ?>
	
    </div>
</div>
<br/>
<br/>
<br/>
<div id="footer">
        <?php include 'assets/html/footer.html'; ?>
</div>
<!-- Local Bootstrap JavaScript files -->
<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</html>
