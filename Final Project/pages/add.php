<?php
session_start();
require '../model/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$isLoggedIn = isset($_SESSION['user_id']); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $amenities = $_POST['amenities'];
    $image_file = null;

    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "./uploads/"; // Correct path
        $image_file = basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_file;
        $uploadOk = 1;

        // Check if file is an actual image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check === false) {
            $error = "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (e.g., 5MB limit)
        if ($_FILES['image']['size'] > 5000000) {
            $error = "File is too large.";
            $uploadOk = 0;
        }

        // Check file formats
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (!in_array($imageFileType, $allowed_extensions)) {
            $error = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk === 0) {
            $error = isset($error) ? $error : "Sorry, your file was not uploaded.";
        } else {
            // Move uploaded file to target directory
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $error = "There was an error uploading your file.";
            }
        }
    }

    if (!isset($error)) {
        // Insert into database
        $stmt = $db->prepare("
            INSERT INTO campsites (name, location, description, amenities, image_url, image_file, created_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        $image_url = $image_file ? 'uploads/' . $image_file : null; // Set the image URL path

        $stmt->execute([
            $name, 
            $location, 
            $description, 
            $amenities, 
            $image_url, 
            $image_file
        ]);

        if ($stmt->rowCount() > 0) {
            header("Location: ../index.php");
            exit;
        } else {
            $error = "Failed to add campsite.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Campsite</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Home</a>
        <div class="ml-auto">
            <?php if ($isLoggedIn): ?>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Add New Campsite</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="add.php" method="POST" enctype="multipart/form-data" class="p-4 border rounded">
                    <div class="form-group">
                        <label for="name">Campsite Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter campsite name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter campsite description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control" placeholder="Enter location" required>
                    </div>
                    <div class="form-group">
                        <label for="amenities">Amenities (comma-separated)</label>
                        <input type="text" name="amenities" id="amenities" class="form-control" placeholder="e.g., Hiking, RV Access, Fire Pit">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Add Campsite</button>
                </form>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger mt-3"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
