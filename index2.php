<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photography Website</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Carousel and card styling adjustments */
        #carouselExample .carousel-item .col-md {
            flex: 0 0 auto;
            width: 20%;
        }

        #carouselExample .carousel-item img {
            height: auto;
            max-height: 200px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            #carouselExample .carousel-item .col-md {
                width: 33.33%;
            }
        }

        @media (max-width: 480px) {
            #carouselExample .carousel-item .col-md {
                width: 50%;
            }
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Photography Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.php">Gallery</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="container mt-4">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                include("functions.php");
                $dblink = db_connect("UI-schema"); // Make sure to have a function db_connect returning a connection object
                $sql = "SELECT * FROM `image`";
                $result = mysqli_query($dblink, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $imageSets = array_chunk($images, 5);
                    $first = true;

                    foreach ($imageSets as $set) {
                        echo '<div class="carousel-item ' . ($first ? 'active' : '') . '">';
                        echo '<div class="row g-0">'; // Use g-0 for no gutters in Bootstrap 5

                        foreach ($set as $image) {
                            echo '<div class="col-md">';
                            echo '<div class="card">';
                            echo '<img src="'.$image['image'].'" class="card-img-top" alt="'.$image['name'].'">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">'.$image['name'].'</h5>';
                            echo '<p class="card-text">Price: '.$image['price'].'</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }

                        echo '</div>';
                        echo '</div>';
                        $first = false;
                    }
                } else {
                    echo '<p class="text-center">No images found in the database.</p>';
                }
                ?>
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
</main>
<footer class="bg-light text-center text-lg-start mt-4">
    <div class="text-center p-3">
        &copy; 2024 Photography Website
    </div>
</footer>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
