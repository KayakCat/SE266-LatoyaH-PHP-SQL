<?php
session_start();
include __DIR__ . '/../model/db.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Fetch patients
$query = "SELECT * FROM patients WHERE 1=1";
$params = [];

if (!empty($_GET['first_name'])) {
    $query .= " AND patientFirstName LIKE :first_name";
    $params[':first_name'] = '%' . $_GET['first_name'] . '%';
}
if (!empty($_GET['last_name'])) {
    $query .= " AND patientLastName LIKE :last_name";
    $params[':last_name'] = '%' . $_GET['last_name'] . '%';
}
if (isset($_GET['marital_status']) && $_GET['marital_status'] !== "") {
    $query .= " AND patientMarried = :marital_status";
    $params[':marital_status'] = $_GET['marital_status'];
}

$stmt = $db->prepare($query);
$stmt->execute($params);
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Patients</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            margin-top: 20px;
            color: #007bff;
        }
        .form-inline .form-control {
            min-width: 200px;
        }
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Search Patients</h1>
        <form method="GET" action="" class="form-inline justify-content-center">
            <div class="form-group mx-2">
                <input type="text" class="form-control" name="first_name" placeholder="First Name">
            </div>
            <div class="form-group mx-2">
                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
            </div>
            <div class="form-group mx-2">
                <select name="marital_status" class="form-control">
                    <option value="">Marital Status</option>
                    <option value="1">Married</option>
                    <option value="0">Single</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mx-2">Search</button>
            <a href="logoff.php" class="btn btn-danger">Log Out</a>

        </form>

        <table class="table table-striped table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Married</th>
                    <th>Birth Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?= htmlspecialchars($patient['patientFirstName']); ?></td>
                    <td><?= htmlspecialchars($patient['patientLastName']); ?></td>
                    <td><?= $patient['patientMarried'] ? "Yes" : "No"; ?></td>
                    <td><?= htmlspecialchars($patient['patientBirthDate']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
