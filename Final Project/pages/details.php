<?php
session_start();
require '../model/db.php';

// Get campsite details
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("<h3>Invalid campsite ID. Please go back to the <a href='http://localhost/SE266-PHP-SQL/Final%20Project/index.php'>homepage</a>.</h3>");
}

$stmt = $db->prepare("SELECT * FROM campsites WHERE id = ?");
$stmt->execute([$id]);
$campsite = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$campsite) {
    die("<h3>Campsite not found. Please go back to the <a href='http://localhost/SE266-PHP-SQL/Final%20Project/index.php'>homepage</a>.</h3>");
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campsite Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .amenities-list {
            list-style: none;
            padding-left: 0;
        }
        .amenities-list li {
            margin-bottom: 5px;
            color: green;
        }
        .reviews {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="http://localhost/SE266-PHP-SQL/Final%20Project/index.php">HOME</a>
        <div class="ml-auto">
            <?php if ($isLoggedIn): ?>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Campsite Details -->
    <div class="container mt-4">
        <div class="jumbotron text-center bg-success text-white">
            <h1 class="display-4"><?= htmlspecialchars($campsite['name']); ?></h1>
            <p class="lead"><?= htmlspecialchars($campsite['description']); ?></p>
        </div>

        <div class="row">
            
            <div class="col-md-6">
            <?php if (!empty($campsite['image_url']) && file_exists("uploads/" . $campsite['image_url'])): ?>
                <img src="uploads/<?= htmlspecialchars($campsite['image_url']); ?>" class="img-fluid" alt="Campsite Image">
            <?php else: ?>
                <img src="uploads/default-image.jpg" class="img-fluid" alt="Default Image">
            <?php endif; ?>

            </div>
            
            <div class="col-md-6">
                <h3>About This Campsite</h3>
                <p><strong>Location:</strong> <?= htmlspecialchars($campsite['location']); ?></p>
                <h5>Amenities:</h5>
                <ul class="amenities-list">
                    <?php foreach (explode(',', $campsite['amenities']) as $amenity): ?>
                        <li><?= htmlspecialchars(trim($amenity)); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="http://localhost/SE266-PHP-SQL/Final%20Project/index.php" class="btn btn-outline-primary">Back to Campsites</a>
                <?php if ($isLoggedIn): ?>
                    <a href="edit.php?id=<?= $campsite['id']; ?>" class="btn btn-warning">Edit</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <footer class="bg-light text-center py-3 mt-4">
        <p>&copy; 2024 Camping Savvy. All rights reserved.</p>
    </footer>
</body>
</html>
