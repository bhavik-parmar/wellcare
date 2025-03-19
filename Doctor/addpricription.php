<?php

include('../dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $patient_name = $_POST['patient-name'];
    $patient_age = $_POST['patient-age'];
    $patient_gender = $_POST['patient-gender'];
    $patient_email = $_POST['email'];
    $patient_phone = $_POST['phone'];
    $date = $_POST['date'];
    $symptoms = $_POST['symptoms'];
    $doctor_id = $_POST['doctor'];
    $doctor_notes = $_POST['doctor-notes'];
    
    // Medicines
    $medicine_names = [];
    $medicine_times = [];
    $medicine_eatings = [];
    $medicine_durations = [];
    
    $medicineCount = 1; 
    while (isset($_POST['medicine-name-' . $medicineCount])) {
        $medicine_names[] = $_POST['medicine-name-' . $medicineCount];
        $medicine_times[] = isset($_POST['medicine-time-' . $medicineCount]) ? implode(",", $_POST['medicine-time-' . $medicineCount]) : "";
        $medicine_eatings[] = $_POST['medicine-eating-' . $medicineCount] ?? "";
        $medicine_durations[] = $_POST['medicine-duration-' . $medicineCount] ?? "";
        $medicineCount++;
    }
    
    // Implode arrays into strings for medicines
    $medicine_names_str = implode("|", $medicine_names);
    $medicine_times_str = implode("|", $medicine_times);
    $medicine_eatings_str = implode("|", $medicine_eatings);
    $medicine_durations_str = implode("|", $medicine_durations);
    
    // Insert data into prescriptions table
    $sql = "INSERT INTO prescriptions (p_name, p_email, p_age, p_gender, date, symptoms, 
            m_name, m_time, m_eating, m_duration, d_notes, doctor_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters and execute the query
        $stmt->bind_param("ssisissssssi", 
            $patient_name, $patient_email, $patient_age, $patient_gender, $date, $symptoms, 
            $medicine_names_str, $medicine_times_str, $medicine_eatings_str, $medicine_durations_str, $doctor_notes, $doctor_id
        );

        if ($stmt->execute()) {
            $last_id = $stmt->insert_id; // Get the last inserted ID
        
            // Redirect to casepaper.php with the specific prescription ID
            header("Location: casepaper.php?prescription_id=" . $last_id);
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error preparing the query: " . $conn->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
