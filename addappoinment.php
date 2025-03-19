<?php
// Include database connection
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $datepicker = trim($_POST['datepicker']);
    $phone = trim($_POST['phone']);
    $doctor_id = trim($_POST['doctor_id']);
    $message = trim($_POST['message']);

    // Validate required fields
    if (empty($name) || empty($email) || empty($datepicker) || empty($phone) || empty($doctor_id)) {
        echo "<script>alert('Please fill in all required fields!'); window.history.back();</script>";
        exit();
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!'); window.history.back();</script>";
        exit();
    }

    // Insert into the database
    $sql = "INSERT INTO appoinment (fname, email, date, phone, doctor_id, msg) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssis", $name, $email, $datepicker, $phone, $doctor_id, $message);

        if ($stmt->execute()) {
            echo "<script>alert('Appointment booked successfully!'); window.location.href = 'page-appointment.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error preparing SQL: " . $conn->error . "'); window.history.back();</script>";
    }

    $conn->close();
}

?>
