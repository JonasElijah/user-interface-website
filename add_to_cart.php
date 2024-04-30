<?php
session_start();
include("functions.php");
$dblink = db_connect("UI-schema");

if(isset($_POST['imageID'])) {
    $imageID = $_POST['imageID'];
    $imageName = $_POST['imageName'];
    $imagePrice = $_POST['imagePrice'];
    $userID = $_SESSION['userID'];

    $sql = "INSERT INTO `orders` (`userID`, `imageID`, `name`, `price`) VALUES ('$userID', '$imageID', '$imageName', '$imagePrice')";
    if($dblink->query($sql)) {
        echo "Success";
    } else {
        echo "Error: " . $dblink->error;
    }
}
?>
