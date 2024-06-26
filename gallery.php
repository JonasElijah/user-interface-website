
<?php
include("functions.php");
session_start();
if(!isset($_SESSION['userID']))
{
	redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/signup.php");
}
$conn = db_connect("UI-schema");
$userId = $_SESSION['userID'];

if (!isset($_SESSION['userID'])) {
    echo "User ID is not set in the session.";
    exit;
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $desc = $_POST["desc"];

    if ($_FILES["image"]["error"] == 4) {
        echo "<script>alert('Image Does Not Exist');</script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($imageExtension, $validImageExtensions)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } else if ($fileSize > 50000000) {
            echo $fileSize;
        } else {
            $existingImageQuery = "SELECT * FROM `image` WHERE `user_id` = '$userId' AND `name` = '$name'";
            $existingImageResult = $conn->query($existingImageQuery);
            if ($existingImageResult->num_rows <= 0) {
                $newImageName = 'img/' . uniqid() . '.' . $imageExtension;
                if (move_uploaded_file($tmpName, $newImageName)) {
                    $query = "INSERT INTO `image` (`category`, `price`, `ds`, `name`,  `image`, `user_id`) VALUES ('$category', $price, '$desc', '$name', '$newImageName', '$userId')";
                    $conn->query($query) or die("Something went wrong with: $query<br>" . $conn->error);
                } else {
                    echo $existingImageResult->num_rows;
                }
            }
        }
    }
}

$sql = "SELECT * FROM `image` WHERE `user_id` = '$userId'";
$result = $conn->query($sql) or die("Something went wrong with: $sql<br>" . $conn->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Photography Website</title>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/assets/css/gallery.css" rel="stylesheet"/>
</head>
<body>
<div id="header">
        <?php include 'assets/html/header.html'; ?>
</div>
<div>
<div class='gallery-title'>
    <div class="header-with-button">
        <h1>Gallery (Keep photos less than a MB)</h1>
        <button type="button" data-bs-toggle="modal" data-bs-target="#myModal" class="nav-link end">Upload</button>
    </div>
    <hr>
</div>
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-body">
                <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="upload">
                        <div class="custom-card">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="modal-title" id="exampleModalLabel">Upload Your Image</h5>
                                    <p class="card-text">Please select an image from your device to upload.</p>
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category:</label>
    					<select name="category" id="category" class="form-control centered-text" required>
                                            <option value="">Select a Category</option>
                                            <option value="Landscape">Landscape</option>
                                            <option value="Portrait">Portrait</option>
                                            <option value="Wildlife">Wildlife</option>
                                            <option value="Macro">Macro</option>
                                            <option value="Street">Street</option>
                                            <option value="Travel">Travel</option>
                                            <option value="Astro">Astro</option>
                                            <option value="Astro">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Description:</label>
                                        <input type="text" name="desc" id="desc" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price:</label>
                                        <input type="number" name="price" id="price" class="form-control" required>
                                        <br>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" class="form-control custom-file-input">
					<button type="button" onclick="document.getElementById('image').click()" class="btn btn-primary">Choose File</button>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <hr>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                	</div>
		</form>
            </div>
        </div>
    </div>
</div>


    <div class="gallery-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
	    <div style="cursor:pointer;" onclick="window.location.href=\'/cart/view-item.php?itemID='.$row['ID'].'\'">
	    <div class="photo-row"><img src="' . $row['image'] . '" alt="' . htmlspecialchars($row['image_alt_text']) . '" /></div>
            </div>';
            }
        } else {
            echo "<p>No images found.</p>";
        }
        ?>
    </div>
</div>

<br />
<br />

<div id="footer">
        <?php include 'assets/html/footer.html'; ?>
</div>

<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
