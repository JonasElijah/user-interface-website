<?php



if(isset($_POST["submit"])) {
  $name = $_POST["name"];
  $category = $_POST["category"];
  $price = $_POST["price"];
  $desc = $_POST["desc"];

  // Check if an image was uploaded
  if($_FILES["image"]["error"] == 4) {
    echo "<script>alert('Image Does Not Exist');</script>";
  } else {
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    // Validate image extension
    $validImageExtensions = ['jpg', 'jpeg', 'png'];
    $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($imageExtension, $validImageExtensions)) {
      echo "<script>alert('Invalid Image Extension');</script>";
    } else if ($fileSize > 1000000) { // Validate image size
      echo "<script>alert('Image Size Is Too Large');</script>";
    } else {
	
    include("functions.php");		
    $conn = db_connect("UI-schema");
    $newImageName = 'img/' . uniqid() . '.' . $imageExtension;	
      // Move the uploaded image to the img directory
     if (move_uploaded_file($tmpName, $newImageName)) {
     } else {
      }


	
      // Insert the image information into the database
      $query = "INSERT INTO `image` (`category`, `price`, `ds`, `name`,  `image`) VALUES ( '$category', $price, '$desc', '$name', '$newImageName')";
      $conn->query($query) or
	      die("Something went wrong with: $query<br>".$conn->error."</p>");
    }
  }
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

	.modal-dialog.modal-fullscreen-sm-down {
	    display: flex;
	    justify-content: center;
	    align-items: center;
	    min-height: 100vh;
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
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
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
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <div>
	<?php	
		echo "<h1>Gallery Placeholder</h1>";
	?>
	<button type="button" data-bs-toggle="modal" data-bs-target="#myModal">Upload</button>
	<div class="modal-dialog modal-fullscreen-sm-down" id = "myModal">
	  
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

