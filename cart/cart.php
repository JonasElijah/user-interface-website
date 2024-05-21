<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Shopping Cart page</title>

<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />	
<link href="/assets/css/cart.css" rel="stylesheet" />	
	
</head>
<body>
	<?php
	if (session_status() === PHP_SESSION_NONE) {
    	session_start();
	}
	?>
<div id="header">
        <?php include '../assets/html/header.html'; ?>
</div>
<?php
$displayName = "";
include("../functions.php");
$dblink = db_connect("UI-schema");

if(!isset($_POST['submit']))
   {
	$displayName .= $_SESSION['userID'];
	$userID = $_SESSION['userID'];
	$sql = "SELECT * FROM `orders` where `userID` LIKE '$userID'";
	$result = mysqli_query($dblink, $sql);
	//$row = $result->fetch_assoc();
	if(mysqli_num_rows($result) == 0)
		{
			echo'<h2 style = "color: #fdf4eb; font-size: 50px;text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;"  align = "center">Shopping cart empty </h2>';

		}
	else
		{
			echo "<div class='row main-background'>";
			echo '<div class = "col-md-9">';
			echo '<br/><br/>';
			echo '<h3 style = "color: #00000; font-size: 30px; margin-left: 15px;"  align = "left">Shopping Cart </h3>';
			echo '<hr>';
			echo '<table class = "table table-striped">';
			echo '<tr>';
			echo '<th scope="col">#</th>';
			echo '<th scope="col">Image</th>';
      			echo '<th scope="col">Name</th>';
      			echo '<th scope="col">Price</th>';
			echo '</tr>';
			$counter = 1;
			$sum = 0;
			$quantity = 0;
			$nameHolder = "";
			while ($data=$result->fetch_array(MYSQLI_ASSOC))
				{
			
				echo '<tr>';
				echo '<td>'.$counter.'</td>';
				if($nameHolder == "")
				{
				$nameHolder .= $data['name'];
				}
				$myImage = $data['imageID'];
				$sqlW = "SELECT `image` FROM `image` where `ID` LIKE '$myImage'";
				$resultW = mysqli_query($dblink, $sqlW);
				if(mysqli_num_rows($resultW) == 0)
					{
			
						echo '<h1>Error,image not found.</h1>';
					}
				else
					{
						while($dataW=$resultW->fetch_array(MYSQLI_ASSOC))
							{
						
								// echo '<td><img src = "'.$dataW['image'].'" style="max-width:250px;"></td>';
								// echo '<td>'.$data['name'].'</td>';
								// echo '<td>'.$data['price'].'</td>';
								// echo '</tr>';
								
								echo '<tr>';
								echo '<td><img src = "../'.$dataW['image'].'" style="max-width:250px;"></td>';
								echo '<td>'.$data['name'].'</td>';
								echo '<td>'.$data['price'].'</td>';
								echo '<td><form method="post" action=""><input type="hidden" name="remove_item_id" value="'.$data['imageID'].'"><button type="submit" class="btn btn-danger">Remove</button></form></td>';
								echo '</tr>';
								$counter++;
								$quantity++;
								$sum += $data['price'];
							}
				
					}
				
				}
			echo '</table>';
			echo '</div>';

	
		//Side Bar
		echo '<div class="col-md-3 sidebar" >';
		echo '<div class="col-md-10 offset-md-1">';
		echo '<div align="center">';
		echo '<img src="assets/images/photography.png" class="profile-img">';
		echo '</div>';
		$sqlN = "SELECT `fName` FROM `user` where `userID` LIKE '$displayName'";
		$resultN = mysqli_query($dblink, $sqlN);
		if(mysqli_num_rows($resultN) == 0)
					{
						echo '<div align="center">';
						echo '<h1>Error,name not found.</h1>';
						echo '</div>';
					}
				else
					{
						while($dataN=$resultN->fetch_array(MYSQLI_ASSOC))
							{
								echo '<div align="center">';
								echo '<td> '.$dataN['fName'].'</td>';
								echo '</div>';
							}
			
			
			echo '</div>';
			echo '<hr>';
			echo '<div class="offset-md-1">';
			echo '</div>';
			echo '<div class="sub-text offset-md-1">';
				echo '<br>';
				echo '<h3>Shopping Cart Total:</h3>';
				echo '<p class="user-info">'.$sum.'</p>';
				echo '<br>';
				echo '<h3>Number of Items</h3>';
				echo '<p class="user-info">'.$quantity.'</p>';
				echo '<br>';
				echo '<form method = "post" action = "">';
				echo '<br><button class="btn btn-success offset-md-3" name="submit" type="submit" value="submit">Check Out</button>';
				echo '</form>';
				echo '<br>';
			echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
}
   }
else
{
$userID = $_SESSION['userID'];

$sqlCheckOwner = "SELECT COUNT(*) AS own_photos 
                  FROM `orders`
                  JOIN `image` ON `orders`.`imageID` = `image`.`ID`
                  WHERE `orders`.`userID` = ? AND `image`.`user_id` = ?";
    
    $stmt = $dblink->prepare($sqlCheckOwner);
    $stmt->bind_param("ss", $userID, $userID); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['own_photos'] > 0) {
        echo "<script>alert('You cannot purchase your own photos. Please remove them from your cart.');</script>";
        echo "<script>window.location.href = 'cart.php';</script>";
    } else {
        $sqlDeleteAll = "DELETE FROM `orders` WHERE `userID` = '$userID'";
        if (mysqli_query($dblink, $sqlDeleteAll)) {
            echo "<script>alert('Checkout successful. All items have been purchased.');</script>";
        } else {
            echo "<script>alert('Error during checkout');</script>";
        }
    }
    $stmt->close();
echo '<div style="background-color: #f8f8f8; width: 50%; margin: 0 auto; padding: 20px;">';
echo '<h2 style="color: black; font-size: 20px; text-shadow: 
      -1px -1px 0 #fdf4eb,
       1px -1px 0 #fdf4eb, 
      -1px 1px 0 #fdf4eb, 
       1px 1px 0 #fdf4eb;" align="center">Thank you for your order! </h2>';
echo '</div>';
}

if (isset($_POST['remove_item_id'])) {
    $imageID = $_POST['remove_item_id'];
    $userID = $_SESSION['userID'];  

    $sqlDelete = "DELETE FROM `orders` WHERE `imageID` = ? AND `userID` = ?";
    $stmt = $dblink->prepare($sqlDelete);
    $stmt->bind_param("ss", $imageID, $userID);  

    if ($stmt->execute()) {
        echo "<script>alert('Item removed successfully');</script>";
        echo "<script>window.location = 'cart.php';</script>"; 
    } 
    $stmt->close();
}


?>
</body>
<div>
	<br>
	<br>
<div id="footer">
        <?php include '../assets/html/footer.html'; ?>
</div>
</div>
</html>