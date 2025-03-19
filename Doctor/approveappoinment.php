<?php
session_start();
include('../dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = $_POST['appointment_id'];
    $patient_email = $_POST['email'];
    $patient_name = $_POST['name'];
    $appointment_date = $_POST['date'];

    // Update appointment status
    $stmt = $conn->prepare("UPDATE appoinment SET status = 'Approved' WHERE id = ?");
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        // Send email to the patient
        $to = $patient_email;
        $subject = "Your Appointment is Approved";
        $message = "Hello $patient_name,\n\nYour appointment has been approved for $appointment_date.\n\nThank you,\nWellcare Team";
        $headers = "From: bhavikp12102@gmail.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "success";
        } else {
            echo "error_sending_email";
        }
    } else {
        echo "error";
    }
    $stmt->close();
    $conn->close();
}
?>
