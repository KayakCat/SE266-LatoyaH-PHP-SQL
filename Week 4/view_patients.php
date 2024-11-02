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
                // Include the model file to access database functions
                include __DIR__ . '/model/model_patients.php';

                // Fetch all patients from the database
                $patients = getAllPatients();
            ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Married</th>
                        <th>Birth Date</th>
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
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
