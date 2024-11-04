<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Patients</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-10">
            <h1>Patients</h1>

            <?php
                
                include __DIR__ . '/model/model_patients.php';
                include __DIR__ . '/function.php';

                // Check if a delete request has been made
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
                    $deleteId = $_POST['delete_id'];
                    $message = deletePatient($deleteId); // Call delete function
                    echo "<div class='alert alert-info'>$message</div>";
                }

                // Fetch all patients from the database after deletion
                $patients = getAllPatients();
            ?>
            <!-- Button to add a new patient -->
            <a href="manage_patients.php" class="btn btn-primary">Add Patient</a>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Married</th>
                        <th>Birth Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($patients as $row): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['patientFirstName']; ?></td>
                        <td><?php echo $row['patientLastName']; ?></td>
                        <td><?php echo $row['patientMarried'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo $row['patientBirthDate']; ?></td>
                        <!-- Buttons added to each row to edit and delete patient details -->
                        <td>
                            <a href="manage_patients.php?action=edit&id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                            <!-- Form to delete the patient -->
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this patient?')">Delete</button>
                        
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
