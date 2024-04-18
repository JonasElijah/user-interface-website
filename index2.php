<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photography Website</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .carousel-item {
            transition: transform 0.5s ease, opacity 0.5s ease-out;
        }
        .carousel-item img {
            height: 200px;
            object-fit: cover;
        }
        .card {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 5px;
            padding: 5px;
            font-size: 0.8rem;
        }
        .carousel-item .row > div {
            padding: 2px;
            flex: 0 0 auto;
            width: 20%;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            padding: 5px;
        }
        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
        }
    </style>
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <nav class="navbar navbar-expand-lg custom-navbar shadow rounded">
        <div class="container-fluid">
            <img src="assets/images/photography.png" alt="Photography Logo" style="max-width: 250px; max-height: 100px" />
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <?php
                    if (!isset($_SESSION['userID'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="account.php">Account</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="category">
    <h1>Recommended</h1>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col"><div class="card"><img src="path_to_image1.jpg" class="card-img-top" alt="Image description"><div class="card-body"><h5 class="card-title">Title 1</h5><p class="card-text">Description 1</p></div></div></div>
                    <div class="col"><div class="card"><img src="path_to_image2.jpg" class="card-img-top" alt="Image description"><div class="card-body"><h5 class="card-title">Title 2</h5><p class="card-text">Description 2</p></div></div></div>
                    <div class="col"><div class="card"><img src="path_to_image3.jpg" class="card-img-top" alt="Image description"><div class="card-body"><h5 class="card-title">Title 3</h5><p class="card-text">Description 3</p></div></div></div>
                    <div class="col"><div class="card"><img src="path_to_image4.jpg" class="card-img-top" alt="Image description"><div class="card-body"><h5 class="card-title">Title 4</h5><p class="card-text">Description 4</p></div></div></div>
                    <div class="col"><div the="card"><img src="path_to_image5.jpg" class="card-img-top" alt="Image description"><div class="card-body"><h5 class="card-title">Title 5</h5><p class="card-text">Description 5</p></div></div></div>
                </div>
            </div>
            <!-- Additional carousel-item blocks for other image sets -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
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
