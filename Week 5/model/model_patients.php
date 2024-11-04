<?php 
include(__DIR__ . '/db.php');
//Function to display patient records
function getAllPatients() {
    global $db;

    $results = [];

    $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients ORDER BY patientLastName");

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results; 
}
//Function to get a single patient by their id number
function getPatientById($id) {
    global $db;
    
    $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Function to add patient to database
function addPatient($firstName, $lastName, $married, $birthDate) {
    global $db;

    $stmt = $db->prepare("INSERT INTO patients (patientFirstName, patientLastName, patientMarried, patientBirthDate)
                          VALUES (:firstName, :lastName, :married, :birthDate)");

    $binds = array(
        ':firstName' => $firstName,
        ':lastName' => $lastName,
        ':married' => (int)$married,
        ':birthDate' => $birthDate
    );

    $stmt->execute($binds);
}

//Function to update patient record
function updatePatient($id, $firstName, $lastName, $married, $birthDate) {
    global $db;

    $results = "Data was not updated";

    // Prepare SQL statement for updating patient information
    $stmt = $db->prepare("UPDATE patients 
                      SET patientFirstName = :firstName, 
                          patientLastName = :lastName, 
                          patientMarried = :married, 
                          patientBirthDate = :birthDate 
                      WHERE id = :id");


    // Bind values to the parameters
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
    $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
    $stmt->bindValue(':married', $married, PDO::PARAM_INT); 
    $stmt->bindValue(':birthDate', $birthDate, PDO::PARAM_STR);

    // Execute the statement and check if a row was updated
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = 'Patient information updated successfully';
    }

    return $results;
}

//Function to delete patient record
function deletePatient($id) {
    global $db;

    $results = "Patient record was not deleted";

    // Prepare SQL statement for deleting a patient
    $stmt = $db->prepare("DELETE FROM patients WHERE id = :id");

    // Bind value to the parameter
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // Execute the statement and check if a row was deleted
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = 'Patient record deleted successfully';
    }

    return $results;
}

/* Example usage for testing:
$patients = getAllPatients();
$patient = $patients[0];
echo $patient['patientFirstName'];
*/
?>
