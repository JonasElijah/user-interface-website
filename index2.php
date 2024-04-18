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
                    $categories = [
                        'Recommended' => function ($img) {
                            return $img['category'] !== 'portrait';
                        },
                        'Portrait' => function ($img) {
                            return $img['category'] === 'portrait';
                        }
                    ];
                    
                    function createCarouselItems($imageSets, $categoryName)
                    {
                        $carouselId = "carousel" . preg_replace('/\s+/', '', $categoryName);
                        echo '<h2>' . $categoryName . '</h2><hr>
                              <div id="' . $carouselId . '" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">';
                        $first = true;
                        foreach ($imageSets as $set) {
                            $activeClass = $first ? 'active' : '';
                            echo '<div class="carousel-item ' . $activeClass . '">
                                    <div class="row">';
                            foreach ($set as $image) {
                                $imagePath = $image['image'];
                                $imageName = $image['name'];
                                $imagePrice = $image['price'];
                                $imageID = (int) $image['ID'];
                    
                                echo '<div class="col-md-2">
                                        <div class="card mb-3" style="cursor:pointer;" onclick="window.location.href=\'view-item.php?itemID=' . $imageID . '\'">
                                            <img src="' . $imagePath . '" class="card-img-top" alt="Image of ' . $imageName . '" title="Click to view details">
                                            <div class="card-body">
                                                <h5 class="card-title">' . $imageName . '</h5>
                                                <p class="card-text">$' . $imagePrice . '</p>
                                                <form method="post" action="">
                                                    <input type="hidden" name="imageID" value="' . $imageID . '">
                                                    <input type="hidden" name="imageName" value="' . $imageName . '">
                                                    <input type="hidden" name="imagePrice" value="' . $imagePrice . '">
                                                    <button class="add-to-cart-btn" type="submit" name="submit">Add to Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                      </div>';
                            }
                            echo '</div></div>';
                            $first = false;
                        }
                        echo '</div>';
                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#' . $carouselId . '" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>';
                        echo '<button class="carousel-control-next" type="button" data-bs-target="#' . $carouselId . '" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                              </button>';
                        echo '</div>';  // End of carousel
                    }
                    
                    foreach ($categories as $categoryName => $filter) {
                        $filteredImages = array_filter($images, $filter);
                        $imageSets = array_chunk($filteredImages, 5);
                        echo '<div id="carouselExample">';
                        createCarouselItems($imageSets, $categoryName);
                        echo '</div>';
                    }
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
