<?php
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once("functions.php");  // Include functions file
    $dblink = db_connect("UI-schema");  // Connect to the database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Photography Website</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/> <!-- External CSS file for custom styles -->
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg custom-navbar shadow rounded">
        <div class="container-fluid">
            <img src="assets/images/photography.png" alt="Photography Logo" style="max-width: 250px; max-height: 100px"/>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="text-center">Photography Website</h1>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.php">Gallery</a>
                    </li>
                    <?php if (!isset($_SESSION['userID'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Signup</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="account.php">Account</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="container">
    <div class="category">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <?php
                $sql = "SELECT * FROM `image`";
                $stmt = $dblink->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows == 0) {
                    echo 'No images found in the database';
                } else {
                    $images = $result->fetch_all(MYSQLI_ASSOC);
                    include("carousel.php");  // Separate file to handle carousel display logic
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                    $imageID = $dblink->real_escape_string($_POST['imageID']);
                    $imageName = $dblink->real_escape_string($_POST['imageName']);
                    $imagePrice = $dblink->real_escape_string($_POST['imagePrice']);
                    $userID = $_SESSION['userID'];

                    $insert_sql = "INSERT INTO `orders` (`userID`, `imageID`, `name`, `price`) VALUES (?, ?, ?, ?)";
                    $insert_stmt = $dblink->prepare($insert_sql);
                    $insert_stmt->bind_param("iisd", $userID, $imageID, $imageName, $imagePrice);
                    $insert_stmt->execute();
                    if ($insert_stmt->affected_rows === 0) {
                        echo "Error adding to cart.";
                    }
                }
            ?>
        </div>
    </div>
</main>
<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">Photography Website &copy; 2024</span>
    </div>
</footer>
<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
