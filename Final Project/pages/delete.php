<?php
session_start();
require '../model/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the campsite ID
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("Invalid campsite ID.");
}

// Delete the campsite
$stmt = $db->prepare("DELETE FROM campsites WHERE id = ?");
$stmt->execute([$id]);

if ($stmt->rowCount() > 0) {
    header("Location: ../index.php");
    exit;
} else {
    die("Failed to delete campsite.");
}
?>
