<?php
session_start();
include('dbconn.php');

if (isset($_POST['loginbtn'])) {
    $email = $_POST['txtemail'];
    $pass = $_POST['txtpass'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = ? AND pass = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $pass);

    // Execute and fetch the result
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // User credentials are valid
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];  // Assuming 'id' is the primary key
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['fname'];

            // Redirect to the user dashboard
            header('Location: userdata.php');
            exit();
        } else {
            echo "<script>alert('Invalid Credentials!');</script>";
        }
    } else {
        echo "<script>alert('Execution failed: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>
