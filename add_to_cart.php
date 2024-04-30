<?php
session_start();
include("functions.php");

if (isset($_POST['submit'])) {
    $dblink = db_connect("UI-schema");
    $imageID = $_POST['imageID'];
    $imageName = $_POST['imageName'];
    $imagePrice = $_POST['imagePrice'];
    $userID = $_SESSION['userID'];  // Ensure you have user session management in place.

    $sql = "INSERT INTO `orders` (`userID`, `imageID`, `name`, `price`) 
            VALUES ('$userID', '$imageID', '$imageName', '$imagePrice')";

    if ($dblink->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Item added to cart successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add item to cart.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received.']);
}
?>
