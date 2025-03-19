<?php
// Include database connection
include '../dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Management</title>

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['appointment_id'])) {
    $appointmentID = intval($_POST['appointment_id']);

    // Check if the appointment exists and is still pending
    $checkQuery = "SELECT * FROM appoinment WHERE id = ? AND status = 'Pending'";
    $checkStmt = $conn->prepare($checkQuery);

    if ($checkStmt) {
        $checkStmt->bind_param("i", $appointmentID);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the appointment details
            $appointment = $result->fetch_assoc();
            $appointmentDate = $appointment['date'];
            $name = $appointment['fname'];
            $email = $appointment['email'];
            $phone = $appointment['phone'];
            $msg = $appointment['msg'];

            // Check if the doctor's schedule is already booked for the same time
            $conflictQuery = "SELECT * FROM appoinment WHERE date = ? AND status = 'Approved'";
            $conflictStmt = $conn->prepare($conflictQuery);
            
            if ($conflictStmt) {
                $conflictStmt->bind_param("s", $appointmentDate);
                $conflictStmt->execute();
                $conflictResult = $conflictStmt->get_result();

                if ($conflictResult->num_rows > 0) {
                    // If conflict is found, display the modal form with editable date and time
                    echo "
                    <div class='modal fade' id='conflictModal' tabindex='-1' aria-labelledby='conflictModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='conflictModalLabel'>Appointment Conflict</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <form method='POST' action='resolve-conflict.php'>
                                        <input type='hidden' name='appointment_id' value='{$appointmentID}'>
                                        <div class='mb-3'>
                                            <label for='dtype' class='form-label'>Doctor Type</label>
                                            <input type='text' class='form-control' id='dtype' name='dtype' value='{$doctorType}' readonly>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='current_date' class='form-label'>Current Appointment Date</label>
                                            <input type='text' class='form-control' id='current_date' name='current_date' value='{$appointmentDate}' readonly>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='new_date' class='form-label'>New Appointment Date & Time</label>
                                            <input type='datetime-local' class='form-control' id='new_date' name='new_date' required>
                                        </div>
                                        <button type='submit' class='btn btn-primary'>Update Appointment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const conflictModal = new bootstrap.Modal(document.getElementById('conflictModal'));
                            conflictModal.show();
                        });
                    </script>
                    ";
                } else {
                    // If no conflict, approve the appointment
                    $approveQuery = "UPDATE appoinment SET status = 'Accepted' WHERE id = ?";
                    $approveStmt = $conn->prepare($approveQuery);

                    if ($approveStmt) {
                        $approveStmt->bind_param("i", $appointmentID);

                        if ($approveStmt->execute()) {
                            echo "<script>
                                    alert('Appointment approved successfully!');
                                    window.location.href = 'admin_appoinments.php';
                                  </script>";
                        } else {
                            echo "<script>
                                    alert('Error approving the appointment: " . $approveStmt->error . "' );
                                    window.history.back();
                                  </script>";
                        }

                        $approveStmt->close();
                    } else {
                        echo "<script>
                                alert('Error preparing the approval query: " . $conn->error . "' );
                                window.history.back();
                              </script>";
                    }
                }

                $conflictStmt->close();
            }
        } else {
            echo "<script>
                    alert('Invalid or already approved appointment!');
                    window.history.back();
                  </script>";
        }

        $checkStmt->close();
    } else {
        echo "<script>
                alert('Error preparing the query: " . $conn->error . "' );
                window.history.back();
              </script>";
    }

    // Close the database connection
    $conn->close();
}
?>
<!-- Add Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
