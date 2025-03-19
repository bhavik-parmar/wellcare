<?php
include '../dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['appointment_id']) && isset($_POST['new_date'])) {
    $appointmentID = intval($_POST['appointment_id']);
    $newDate = $_POST['new_date'];

    // Update the appointment date and time
    $updateQuery = "UPDATE appoinment SET date = ?, status = 'Accepted' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);

    if ($updateStmt) {
        $updateStmt->bind_param("si", $newDate, $appointmentID);
        
        if ($updateStmt->execute()) {
            echo "<script>
                    alert('Appointment date updated successfully!');
                    window.location.href = 'admin_appoinments.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error updating the appointment: " . $updateStmt->error . "');
                    window.history.back();
                  </script>";
        }

        $updateStmt->close();
    } else {
        echo "<script>
                alert('Error preparing the update query: " . $conn->error . "');
                window.history.back();
              </script>";
    }

    $conn->close();
}
?>
