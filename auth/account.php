<?php
	include("../functions.php");
	
	if (session_status() === PHP_SESSION_NONE) {
    	session_start();
	}
	
	if(!isset($_SESSION['userID'])){
		redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/login.php");
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
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <div id="header">
        <?php include '../assets/html/header.html'; ?>
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
						echo '<a class="nav-link active" href="/auth/account.php">Profile</a>';
					echo '</li>';
					echo '<li class="nav-item">';
						echo '<a class="nav-link" href="#">Payment Options</a>';
					echo '</li>';
					echo '<li class="nav-item">';
						echo '<a class="nav-link" href="#">Biography</a>';
					echo '</li>';
					echo '<li class="nav-item">';
						echo '<a class="nav-link" href="/gallery.php">View Gallery</a>';
					echo '</li>';
				echo '</ul>';
			echo '</div>';
		echo '</div>';
		echo '</div>';
		
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
