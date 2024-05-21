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

    if(!isset($_POST['submit'])) {
        $displayName .= $_SESSION['userID'];
        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM `orders` WHERE `userID` = '$userID'";
        $result = mysqli_query($dblink, $sql);

        if(mysqli_num_rows($result) == 0) {
            echo '<h2 style="color: #fdf4eb; font-size: 50px; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;" align="center">Shopping cart empty</h2>';
        } else {
            echo "<div class='row main-background'>";
            echo '<div class="col-md-9">';
            echo '<br/><br/>';
            echo '<h3 style="color: rgb(86, 86, 86); font-size: 45px; margin-left: 25px;" align="left">Shopping Cart</h3>';
            echo '<hr>';
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">#</th>';
            echo '<th scope="col">Image</th>';
            echo '<th scope="col">Name</th>';
            echo '<th scope="col">Price</th>';
            echo '<th scope="col">Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            $counter = 1;
            $sum = 0;
            $quantity = 0;

            while ($data = $result->fetch_array(MYSQLI_ASSOC)) {
                $myImage = $data['imageID'];
                $sqlW = "SELECT `image` FROM `image` WHERE `ID` = '$myImage'";
                $resultW = mysqli_query($dblink, $sqlW);

                if(mysqli_num_rows($resultW) > 0) {
                    $dataW = $resultW->fetch_array(MYSQLI_ASSOC);

                    echo '<tr>';
                    echo '<td>'.$counter.'</td>';
                    echo '<td><img src="../'.$dataW['image'].'" style="max-width:100px;"></td>';
                    echo '<td>'.$data['name'].'</td>';
                    echo '<td>$'.$data['price'].'</td>';
                    echo '<td><form method="post" action=""><input type="hidden" name="remove_item_id" value="'.$data['imageID'].'"><button type="submit" class="btn btn-danger">Remove</button></form></td>';
                    echo '</tr>';

                    $counter++;
                    $quantity++;
                    $sum += $data['price'];
                }
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';

            // Side Bar
            echo '<div class="col-md-3 sidebar">';
            echo '<div class="col-md-10 offset-md-1">';
            echo '<div align="center">';
            echo '<img src="assets/images/photography.png" class="profile-img">';
            echo '</div>';

            $sqlN = "SELECT `fName` FROM `user` WHERE `userID` = '$displayName'";
            $resultN = mysqli_query($dblink, $sqlN);
            if(mysqli_num_rows($resultN) > 0) {
                $dataN = $resultN->fetch_array(MYSQLI_ASSOC);
                echo '<div align="center">';
                echo '<h4>'.$dataN['fName'].'</h4>';
                echo '</div>';
            }

            echo '<hr>';
            echo '<div align="center">';
            echo '<h3>Shopping Cart Total: $'.$sum.'</h3>';
            echo '<h3>Number of Items: '.$quantity.'</h3>';
            echo '<form method="post" action="">';
            echo '<button class="btn btn-success" name="submit" type="submit" value="submit">Check Out</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        // Check Out Logic
        $userID = $_SESSION['userID'];
        $sqlCheckOwner = "SELECT COUNT(*) AS own_photos FROM `orders` JOIN `image` ON `orders`.`imageID` = `image`.`ID` WHERE `orders`.`userID` = ? AND `image`.`user_id` = ?";
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
        echo '<h2 style="color: black; font-size: 20px; text-shadow: -1px -1px 0 #fdf4eb, 1px -1px 0 #fdf4eb, -1px 1px 0 #fdf4eb, 1px 1px 0 #fdf4eb;" align="center">Thank you for your order!</h2>';
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