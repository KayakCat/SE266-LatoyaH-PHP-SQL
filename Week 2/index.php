<?php
//include funtions and header files
include 'includes/functions.php'; 
include 'includes/header.php'; 

// Define variables 
$firstName = $lastName = $married = $birthDate = $height_ft = $height_in = $weight = "";
$firstNameErr = $lastNameErr = $marriedErr = $birthDateErr = $heightErr = $weightErr = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    if (empty($_POST["first_name"])) {
        $firstNameErr = "First name is required";
    } else {
        $firstName = htmlspecialchars($_POST["first_name"]);
    }

    // Validate last name
    if (empty($_POST["last_name"])) {
        $lastNameErr = "Last name is required";
    } else {
        $lastName = htmlspecialchars($_POST["last_name"]);
    }

    // Validate married status
    if (empty($_POST["married"])) {
        $marriedErr = "Please select your marital status";
    } else {
        $married = htmlspecialchars($_POST["married"]);
    }

    // Validate birth date
    if (empty($_POST["birth_date"])) {
        $birthDateErr = "Birth date is required";
    } elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST["birth_date"]) || !isDate($_POST["birth_date"])) {
        $birthDateErr = "Please enter a valid date (YYYY-MM-DD)";
    } else {
        $birthDate = $_POST["birth_date"];
    }

    // Validate height
    if (empty($_POST["height_ft"]) || empty($_POST["height_in"])) {
        $heightErr = "Height is required";
    } elseif (!is_numeric($_POST["height_ft"]) || !is_numeric($_POST["height_in"]) || $_POST["height_ft"] < 0 || $_POST["height_in"] < 0) {
        $heightErr = "Please enter a valid height";
    } else {
        $height_ft = htmlspecialchars($_POST["height_ft"]);
        $height_in = htmlspecialchars($_POST["height_in"]);
    }

    // Validate weight
    if (empty($_POST["weight"])) {
        $weightErr = "Weight is required";
    } elseif (!is_numeric($_POST["weight"]) || $_POST["weight"] <= 0) {
        $weightErr = "Please enter a valid weight";
    } else {
        $weight = htmlspecialchars($_POST["weight"]);
    }

    // Calculate the patient's age
if (!empty($birthDate)) {
    $patientAge = age($birthDate); 
}

    // If no errors, calculate BMI
    if (empty($firstNameErr) && empty($lastNameErr) && empty($marriedErr) && empty($birthDateErr) && empty($heightErr) && empty($weightErr)) {
        // Perform the BMI calculation
        $bmiValue = bmi($height_ft, $height_in, $weight);
        $bmiCategory = bmiDescription($bmiValue);
        
        // Display BMI result using built in round function
        echo "<h3>BMI: " . round($bmiValue, 2) . " (" . $bmiCategory . ")</h3>";
        echo "<h3>Age: " . $patientAge . " years</h3>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Intake Form</title>
</head>
<body>
    <h2>Patient Intake Form</h2>
    <!--code to create intake form using post method to make values stick-->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        First Name: <input type="text" name="first_name" value="<?php echo $firstName; ?>">
        <span><?php echo $firstNameErr; ?></span><br><br>
        
        Last Name: <input type="text" name="last_name" value="<?php echo $lastName; ?>">
        <span><?php echo $lastNameErr; ?></span><br><br>
        
        Married: 
        <input type="radio" name="married" value="yes" <?php if ($married == "yes") echo "checked"; ?>>Yes
        <input type="radio" name="married" value="no" <?php if ($married == "no") echo "checked"; ?>>No
        <span><?php echo $marriedErr; ?></span><br><br>

        Birth Date: <input type="text" name="birth_date" placeholder="YYYY-MM-DD" value="<?php echo $birthDate; ?>">
        <span><?php echo $birthDateErr; ?></span><br><br>

        Height: 
        <input type="text" name="height_ft" value="<?php echo $height_ft; ?>" placeholder="Feet"> ft
        <input type="text" name="height_in" value="<?php echo $height_in; ?>" placeholder="Inches"> in
        <span><?php echo $heightErr; ?></span><br><br>

        Weight: <input type="text" name="weight" value="<?php echo $weight; ?>" placeholder="Weight in lbs">
        <span><?php echo $weightErr; ?></span><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php include 'includes/footer.php'; ?>
