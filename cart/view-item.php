<?php
	include("../functions.php");
	
	if (session_status() === PHP_SESSION_NONE) {
    	session_start();
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
	<link href="/assets/css/view-item.css" rel="stylesheet" />
  </head>
  <body>
   <div id="header">
        <?php include '../assets/html/header.html'; ?>
</div>
	<?php
		$imageId = $_GET['itemID'];
		$dblink=db_connect("UI-schema");
		$sql="SELECT * FROM `image` where `ID` LIKE '$imageId'";
		$result=$dblink->query($sql) or
			die("<p>Something went wrong with: <br>$sql<br>".$dblink->error."</p>");
		$data=$result->fetch_array(MYSQLI_ASSOC);
	  
	  	if(!isset($_POST['submit']))
		{
		echo '<br/><h3 class="photo-title">'.$data['name'].'</h3><hr>';

			echo '<div class="row main-view">';
				//Display Image
				echo '<div class="col-md-6 item">';
				echo '<img src="../'.$data['image'].'" class="photo-cus">';
				echo '</div>';

				//Description
				echo '<div class="col-md-6">';
				echo '<br><hr>';
				echo '<p>Description of the photo</p>';
				echo '<p class="desc">"'.$data['ds'].'"</p>';
					echo '<div>';
					echo '<hr><br>';
						echo '<div class="row">';
						echo '<h5 class="col-md-2 offset-md-5">Price:</h5>';
						echo '<h5 class="col-md-4 price-val">$'.$data['price'].'</h5>';
						echo '</div>';
					echo '</div>';
					echo '<br><br><br>';
					echo '<div>';
						
						if(isset($_GET['addItem']))
						{
							if($_GET['addItem']=='success')
							{
								echo '<div class="col-md-4 offset-md-7">';
								echo '<p class="alert alert-success">Successfully Added to Cart!</p>';
								echo '</div>';
							}
							else
							{
								echo '<div class="col-md-3 offset-md-8">';
								echo '<p class="alert alert-danger">Item Already in Cart!</p>';
								echo '</div>';
							}
						}
						else
						{
							echo '<form class="col-md-3 offset-md-8" method="post" action="">';
							echo '<button class="btn btn-outline-secondary" name="submit" type="submit" value="submit">Add to Cart</button>';
							echo '</form>';
						}
					echo '</div>';
				echo '</div>';

			echo '</div>';
			echo '</div>';
		}
	  	if(isset($_POST['submit']))
		{	
			if(!isset($_SESSION['userID']))
			{
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/login.php");
			}
			
			$userID = $_SESSION['userID'];
			$imageID = $_GET['itemID'];
			$name = $data['name'];
			$price = $data['price'];
			
			$sql="SELECT * FROM `orders` WHERE `userID` LIKE '$userID' AND `imageID` LIKE '$imageID'";
			$result = mysqli_query($dblink, $sql);
			if(mysqli_num_rows($result) == 0)
			{
				$sql="Insert into `orders` (`userID`,`imageID`,`name`,`price`) values ('$userID','$imageID','$name','$price')";
				$dblink->query($sql) or
					die("Something went wrong with: $sql<br>".$dblink->error."</p>");
				
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/cart/view-item.php?itemID=$imageID&addItem=success");
			}
			else
			{
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/cart/view-item.php?itemID=$imageID&addItem=failed");
			}
		}
	?>

   <br />
    <br />
    <br />
	
	<div class="row">
   <div id="footer">
        <?php include '../assets/html/footer.html'; ?>
</div>
	</div>
		
    <!-- Local Bootstrap JavaScript files -->
    <script src="../node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
