<?php
session_start();
require '../model/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$isLoggedIn = isset($_SESSION['user_id']); 



// Get the campsite by ID
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("Invalid campsite ID.");
}

$stmt = $db->prepare("SELECT * FROM campsites WHERE id = ?");
$stmt->execute([$id]);
$campsite = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$campsite) {
    die("Campsite not found.");
}


// Update the campsite
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $description = isset($_POST['description']) ? trim($_POST['description']) : null;
    $location = isset($_POST['location']) ? trim($_POST['location']) : null;
    $amenities = isset($_POST['amenities']) ? trim($_POST['amenities']) : null;
    $image_file = $campsite['image_file']; // Default to the current image file in the database

    
    if (!$name || !$description || !$location) {
        $error = "Please fill in all required fields.";
    } else {
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/';
            $uploadFile = $uploadDir . uniqid('img_', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            // Check if upload directory exists
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Move the uploaded file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $image_file = basename($uploadFile); 
            } else {
                $error = "Failed to upload the image.";
            }
        }

        // Update the database
        if (!isset($error)) {
            $stmt = $db->prepare("
                UPDATE campsites 
                SET 
                    name = ?, 
                    location = ?, 
                    description = ?, 
                    amenities = ?, 
                    image_file = ? 
                WHERE id = ?
            ");

            // Execute the statement
            if ($stmt->execute([
                $name,
                $location,
                $description,
                $amenities,
                $image_file,
                $id,
            ])) {
                // Redirect if successful
                header("Location: ../index.php");
                exit;
            } else {
                $error = "Failed to update campsite.";
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Campsite</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../index.php">HOME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if ($isLoggedIn): ?>
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a href="login.php" class="btn btn-primary">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
    <div class="container mt-5">
        <h1 class="text-center">Edit Campsite</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="edit.php?id=<?= $campsite['id'] ?>" method="POST" class="p-4 border rounded" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Campsite Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($campsite['name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required><?= htmlspecialchars($campsite['description']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control" value="<?= htmlspecialchars($campsite['location']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="amenities">Amenities (comma-separated)</label>
                        <input type="text" name="amenities" id="amenities" class="form-control" value="<?= htmlspecialchars($campsite['amenities']); ?>">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Update Campsite</button>
                </form>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger mt-3"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
