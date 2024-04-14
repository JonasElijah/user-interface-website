<?php

include("functions.php");
/*
if (count($errStatus)>0)
{
	$errString=implode("&",$errStatus);
	redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/signup.php?$errString");
}
			
$conn = db_connect("UI-schema");
*/
/*
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
      // Generate a unique name for the image
      $newImageName = uniqid() . '.' . $imageExtension;

      // Move the uploaded image to the img directory
      move_uploaded_file($tmpName, 'assets/images/' . $newImageName);

      // Insert the image information into the database
      $query = "INSERT INTO your_table_name (name, category, price, `desc`, image) VALUES ('$name', '$category', $price, '$desc', '$newImageName')";
      if(mysqli_query($conn, $query)) {
        echo "<script>alert('Successfully Added'); document.location.href = 'data.php';</script>";
      } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
      }
    }
  }
}
*/
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
        padding: 50px;
      }

      .photo-row img {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-right: 20px;
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
        cursor: pointer;
        background-color: #007bff;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 5px;
      }
      
      .custom-card .form-group label {
        flex: 0 0 120px; /* Adjust the width of the label as needed */
      }
      
      .custom-card .form-group input {
        flex: 1;
        padding: 10px;
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
                <a class="nav-link" href="#">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="signup.php">Signup</a>
              </li>

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
    <br /><br /><br />

    <div class="upload">
      <div class="custom-card">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Upload Your Image</h3>
            <p class="card-text">Please select an image from your device to upload.</p>
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
              <label for="upload" class="custom-file-label">Choose File</label>
              <input type="file" id="upload" accept=".jpg, .jpeg, .png" class="custom-file-input">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Upload</button>
          </div>
        </div>
      </div>
    </div>
    <a href="data.php"> Data</a>

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

