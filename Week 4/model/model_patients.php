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

/* Example usage for testing:
$patients = getAllPatients();
$patient = $patients[0];
echo $patient['patientFirstName'];
*/
?>
