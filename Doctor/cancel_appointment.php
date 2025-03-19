<?php
include('../dbconn.php');

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Update the appointment status to 'Cancelled'
    $updateQuery = "UPDATE appoinment SET status = 'Cancelled' WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);

    if ($stmt) {
        $stmt->bind_param("i", $appointmentId);
        if ($stmt->execute()) {
            // Send cancellation email to the patient
            // (You can use the same approach as the email sent during approval)
            $subject = "Appointment Cancelled";
            $message = "
                <html>
                <head>
                    <title>Appointment Cancelled</title>
                </head>
                <body>
                    <h2>Dear Patient,</h2>
                    <p>We regret to inform you that your appointment has been cancelled. Please contact us for further assistance.</p>
                    <p>Thank you for your understanding.</p>
                </body>
                </html>
            ";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <your_email@example.com>' . "\r\n";
            
            // Get the patient's email from the database and send the email
            $selectQuery = "SELECT email FROM appoinment WHERE id = ?";
            $selectStmt = $conn->prepare($selectQuery);
            $selectStmt->bind_param("i", $appointmentId);
            $selectStmt->execute();
            $result = $selectStmt->get_result();
            if ($result->num_rows > 0) {
                $patient = $result->fetch_assoc();
                $email = $patient['email'];
                mail($email, $subject, $message, $headers);
            }

            echo "<script>
                    alert('Appointment cancelled successfully and email sent!');
                    window.location.href = 'appoinments.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error cancelling appointment!');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('Error preparing the cancellation query: " . $conn->error . "');
                window.history.back();
              </script>";
    }
}
?>
