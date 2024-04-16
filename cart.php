<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Sign Up Page</title>

<link href="node_modules/css/bootstrap.min.css" rel="stylesheet">
<link href="node_modules/css/bst-styles.css" rel="stylesheet">
<link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />	
<style>
      header {
	       background-color: #fdf4eb;
      }

      body {
        font-family: "Georgia", sans-serif;
	display: flex;
    	flex-direction: column;
	background-image: url('/assets/images/gallery/trees-3822149_1280.jpg');
	
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
	.footer {
	margin-top: auto; /* Push the footer to the bottom */
	}
	.form
	{
		background-color: #fdf4eb;
	}

    </style>
	
</head>
<body>
	<?php
	if (session_status() === PHP_SESSION_NONE) {
    	session_start();
	}
	?>
	<div>
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
	<h1 class="text-center"> Photo Bucket </h1>
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
		    <?php
			    if(!isset($_SESSION['userID'])){
			echo '<li class="nav-item"> ';
               	 	echo ' <a class="nav-link" href="#">Login</a>';
              		echo '</li>';
              		echo '<li class="nav-item">';
                	echo '<a class="nav-link" href="signup.php">Signup</a>';
              		echo ' </li>';
			       }
			    else
			    {
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
</div>

	
<h1 style = "color: #fdf4eb; font-size: 50px;text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;"  align = "center">Shopping Cart </h1>
<?php
	
include("functions.php");
$dblink = db_connect("UI-schema");

$userID = $_SESSION['userID'];
$sql = "SELECT * FROM `orders` where `userID` LIKE '$userID'";
$result = mysqli_query($dblink, $sql);
//$row = $result->fetch_assoc();
if(mysqli_num_rows($result) == 0)
{
			
	echo '<h1>Error, cart not found. Please log in or add to your cart.</h1>';
}
else
{
	$data=$result->fetch_array(MYSQLI_ASSOC);
	echo '<table>';
	echo '<tr>';
	echo '<td>'.$data['imageID'].'</td>';
	echo '<td>'.$data['name'].'</td>';
	echo '<td>'.$data['price'].'</td>';
	echo '</tr>';
	while ($data=$result->fetch_array(MYSQLI_ASSOC))
		{
			
			echo '<tr>';
			echo '<td>'.$data['imageID'].'</td>';
			echo '<td>'.$data['name'].'</td>';
			echo '<td>'.$data['price'].'</td>';
			echo '</tr>';
		}
	echo '</table>';
		
	}
?>
</body>
</html>
