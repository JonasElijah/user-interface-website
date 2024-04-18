<?php
include("functions.php");
session_start();
if(!isset($_SESSION['userID']))
{
	redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/signup.php");
}
$conn = db_connect("UI-schema");
$userId = $_SESSION['userID'];

if (!isset($_SESSION['userID'])) {
    echo "User ID is not set in the session.";
    exit; // Exit if user ID is not set
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $desc = $_POST["desc"];

    // Check if an image was uploaded
    if ($_FILES["image"]["error"] == 4) {
        echo "<script>alert('Image Does Not Exist');</script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($imageExtension, $validImageExtensions)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } else if ($fileSize > 50000000) { 
            /*echo "<script>alert('Image Size Is Too Large');</script>";*/
	    echo $fileSize;
        } else {
            $existingImageQuery = "SELECT * FROM `image` WHERE `user_id` = '$userId' AND `name` = '$name'";
            $existingImageResult = $conn->query($existingImageQuery);
            if ($existingImageResult->num_rows <= 0) {
                $newImageName = 'img/' . uniqid() . '.' . $imageExtension;
                if (move_uploaded_file($tmpName, $newImageName)) {
                    $query = "INSERT INTO `image` (`category`, `price`, `ds`, `name`,  `image`, `user_id`) VALUES ('$category', $price, '$desc', '$name', '$newImageName', '$userId')";
                    $conn->query($query) or die("Something went wrong with: $query<br>" . $conn->error);
                } else {
			echo $existingImageResult->num_rows;
                    /*echo "<script>alert('Failed to move uploaded file.');</script>";*/
                }
            }
        }
    }
}

$sql = "SELECT * FROM `image` WHERE `user_id` = '$userId'";
$result = $conn->query($sql) or die("Something went wrong with: $sql<br>" . $conn->error);
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
	     .upload 
      {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
      }
      
      .custom-card 
      {
        max-width: 400px;
        width: 100%;
      }
      
      .custom-card .card 
      {
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fdf4eb;
      }
      
      .custom-card .card-body 
      {
        text-align: center;
      }
      
      .custom-card .btn-primary
      {
        display: block;
        margin: 20px auto;
      }
      
      .custom-card .custom-file-input
      {
        display: none;
      }
      
      .custom-card .custom-file-label
      {
	display: block;
	margin: 20px auto;
      }
      
      .custom-card .form-group label {
        flex: 0 0 120px; /* Adjust the width of the label as needed */
      }
      
      .custom-card .form-group input {
        flex: 1;
        padding: 10px;
      }        
	.photo-row img {
	    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Enhanced shadow for depth */
	    margin: 15px; /* Uniform margin around images */
	    padding: 15px; /* Padding inside the image container, if needed */
	    max-width: 250px; /* Smaller maximum width for the images */
	    height: auto; /* Maintain aspect ratio */
	    display: block; /* Ensures proper handling of margins and alignment */
	    object-fit: contain; /* Ensures the image is scaled properly within its element */
	    transition: transform 0.3s ease; /* Smooth transition for the transform property */
	}
	
	.photo-row img:hover {
	    transform: scale(1.1); /* Scale the image up by 10% on hover */
	}
	
	/* Adjusting the container for better layout and responsiveness */
	.gallery-container {
	    display: flex; /* Flexbox for better layout control */
	    flex-wrap: wrap; /* Allows wrapping to the next line */
	    justify-content: space-around; /* Even spacing around each item */
	    padding: 20px; /* Padding around the entire gallery */
	}
	
	/* Responsive behavior for smaller screens */
	@media (max-width: 768px) {
	    .photo-row img {
	        margin: 0.5px; /* Smaller margin for smaller screens */
	        max-width: 90px; /* Slightly smaller width on small devices */
	    }
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
		echo "<br/><h1>Gallery</h1><hr>";
	?>
	<!-- Button to launch modal -->
	
	<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-fullscreen-sm-down">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
		    <div class="upload">
		      <div class="custom-card">
		        <div class="card">
		          <div class="card-body">
			    <h5 class="modal-title" id="exampleModalLabel">Upload Your Image</h5>
		            <p class="card-text">Please select an image from your device to upload.</p>
			    <div class="form-group">
		              <label for="name">Name:</label>
		              <input type="text" name="name" id="name" class="form-control" required value="">
		            </div>
		            <div class="form-group">
		              <label for="category">Category:</label>
		              <input type="text" name="category" id="category" class="form-control" required value="">
		            </div>
		            <div class="form-group">
		              <label for="desc">Description:</label>
		              <input type="text" name="desc" id="desc" class="form-control" required value="">
		            </div>
		            <div class="form-group">
		              <label for="price">Price:</label>
		              <input type="number" name="price" id="price" class="form-control" required value="">
		              <br>
		            </div>
		            <div class="form-group">
		     	      <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value="" class="custom-file-label">
			    </div>
		            <button type = "submit" name = "submit">Submit</button>
		          </div>
		        </div>
		      </div>
		    </div>
	    	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="gallery-container">
    <?php 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
	    <div style="cursor:pointer;" onclick="window.location.href=\'view-item.php?itemID='.$row['ID'].'\'">
	    <div class="photo-row"><img src="' . $row['image'] . '" alt="' . htmlspecialchars($row['image_alt_text']) . '" /></div>
            </div>';
        }
    } else {
        echo "<p>No images found.</p>";
    }
    ?>
</div>
	
          	
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
