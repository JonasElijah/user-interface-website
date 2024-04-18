<?php
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
?>
