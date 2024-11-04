<?php 
include __DIR__ . '/model/model_patients.php';
include __DIR__ . '/function.php';

// Initialize variables
$error = "";
$firstName = "";
$lastName = ""; 
$married = "";
$birthDate = "";

// GET request for editing
if (isGetRequest()) {
    $patientId = filter_input(INPUT_GET, 'id');
    if ($patientId) {
        $patient = getPatientById($patientId);
        $firstName = $patient['patientFirstName'];
        $lastName = $patient['patientLastName'];
        $married = $patient['patientMarried'] ? 'Yes' : 'No';
        $birthDate = $patient['patientBirthDate'];
    }
}

// Check if form has been submitted via POST method
if (isPostRequest()) {
    // Get and clean data
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $married = filter_input(INPUT_POST, 'married');
    $birthDate = filter_input(INPUT_POST, 'birthDate');

    // Validate input and display error if any
    if ($firstName == "") $error .= "<li>Please provide patient's first name</li>";
    if ($lastName == "") $error .= "<li>Please provide patient's last name</li>";
    if ($married == "") $error .= "<li>Please select marital status</li>";
    if ($birthDate == "") $error .= "<li>Please provide a valid birth date</li>";

    if ($error == "") {
        // Convert married value to integer (1 or 0) before adding to database
        $marriedValue = ($married === 'Yes') ? 1 : 0;

        // Check which action button was clicked
        if (isset($_POST['storePatient'])) {
            addPatient($firstName, $lastName, $marriedValue, $birthDate);
            header('Location: view_patients.php');
            exit();
        } elseif (isset($_POST['updatePatient'])) {
            updatePatient($patientId, $firstName, $lastName, $marriedValue, $birthDate);
            header('Location: view_patients.php');
            exit();
        } elseif (isset($_POST['deletePatient'])) {
            deletePatient($patientId);
            header('Location: view_patients.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Add Patient</h2>

        <!-- Link to return to the View Patients page -->
        <div class="text-center mb-3">
            <a class='btn btn-secondary' href="view_patients.php">Back to View All Patients</a>
        </div>

        <!-- Display errors, if any -->
        <form name="patients" method="post">
            <?php if ($error != ""): ?>
            <div class="alert alert-danger">
                <p>Please fix the following and resubmit:</p>
                <ul>
                    <?php echo $error; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <!-- Start of form fields -->
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" class="form-control" value="<?= $firstName; ?>" />
            </div>
            
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" class="form-control" value="<?= $lastName; ?>" />
            </div>
            
            <div class="form-group">
                <label for="married">Is the patient married?</label>
                <select id="married" name="married" class="form-control">
                    <option value="">Select...</option>
                    <option value="Yes" <?= ($married === 'Yes') ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?= ($married === 'No') ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="birthDate">Birth Date:</label>
                <input type="date" id="birthDate" name="birthDate" class="form-control" value="<?= $birthDate; ?>" />
            </div>
            
            <!-- Submit and Cancel buttons -->
            <div class="text-center mt-3">
                <input class="btn btn-success" type="submit" name="storePatient" value="Add Patient Information" />
            </div>
        </form>

        <div class="text-center mt-2">
            <a class="btn btn-warning" href="view_patients.php">Cancel</a> 
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
