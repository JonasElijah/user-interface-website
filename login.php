<?php
session_start();

if (isset($_POST['submit'])) {
    $errStatus = array();

    $email = $_POST['email'];
    $pWord = $_POST['password'];

    if ($email == NULL) {
        $errStatus[] = "email=emailNull";
    } elseif (!preg_match('/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email)) {
        $errStatus[] = "email=emailInvalid";
    }

    $_SESSION['email'] = $email;

    if ($pWord == NULL) {
        $errStatus[] = "password=pWordNull";
    }

    $_SESSION['password'] = $pWord;

    include("functions.php");

    if (count($errStatus) > 0) {
        $errString = implode("&", $errStatus);
        header("Location: login.php?$errString");
        exit();
    }

    $dblink = db_connect("UI-schema");

    $email = addslashes($email);
    $pWord = addslashes($pWord);

    $sql = "SELECT `pWord`, `email`, `userID` FROM `user` WHERE `email` LIKE '$email'";
    $result = mysqli_query($dblink, $sql);
    $row = $result->fetch_assoc();

    if ($row < 0) {
        header("Location: login.php?email=emailNonexist");
        exit();
    } else {
        if ($row['pWord'] != $pWord) {
            header("Location: login.php?password=pWordNonexist");
            exit();
        } else {
            $_SESSION['userID'] = $row['userID'];
            header("Location: index.php");
            exit();
        }
    }
}
?>
