<?php
session_start();
require './model/db.php';

// Get campsites from the database
$stmt = $db->prepare("SELECT * FROM campsites");
$stmt->execute();
$campsites = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camping Savvy</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .campsite-card {
            margin-bottom: 20px;
        }
        .search-bar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="http://localhost/SE266-PHP-SQL/Final%20Project/index.php">HOME</a>
        <div class="ml-auto">
            <?php if ($isLoggedIn): ?>
                <a href="pages/logout.php" class="btn btn-danger">Logout</a>
            <?php else: ?>
                <a href="pages/login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    
    <div class="jumbotron text-center bg-success text-white">
        <h1 class="display-4">Welcome to Camping Savvy</h1>
        <p class="lead">Find your perfect campsite from our curated recommendations.</p>
    </div>

    
    <div class="container">
        <div class="row">
            <?php foreach ($campsites as $campsite): ?>
                <div class="col-md-4">
                    <div class="card campsite-card">
                        <?php if (!empty($campsite['image_url']) && file_exists("pages/uploads/" . $campsite['image_url'])): ?>
                            <img src="pages/uploads/<?= htmlspecialchars($campsite['image_url']); ?>" class="img-fluid" alt="Campsite Image">
                        <?php else: ?>
                            <img src="pages/uploads/default-image.jpg" class="img-fluid" alt="Default Image">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($campsite['name']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($campsite['description']); ?></p>
                            <p><strong>Location:</strong> <?= htmlspecialchars($campsite['location']); ?></p>
                            <a href="pages/details.php?id=<?= $campsite['id']; ?>" class="btn btn-success">View Details</a>
                            <?php if ($isLoggedIn): ?>
                                <a href="pages/edit.php?id=<?= $campsite['id']; ?>" class="btn btn-outline-success">Edit</a>
                                <a href="pages/delete.php?id=<?= $campsite['id']; ?>" class="btn btn-outline-dark" 
                                   onclick="return confirm('Are you sure you want to delete this campsite?');">Delete</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if ($isLoggedIn): ?>
        <div class="container text-center mt-4">
            <a href="pages/add.php" class="btn btn-success">Add New Campsite</a>
        </div>
    <?php endif; ?>

   
    <footer class="bg-light text-center py-3 mt-4">
        <p>&copy; 2024 Camping Savvy. All rights reserved.</p>
    </footer>
</body>
</html>
