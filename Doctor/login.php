<?php
session_start();
include('../dbconn.php');

if (isset($_POST['loginbtn'])) {
    $uname = $_POST['txtuname'];
    $pass = $_POST['txtpass'];



    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM doctor WHERE uname = ? AND pass = ?");
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("ss", $uname, $pass);

    // Execute and fetch the result
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Admin credentials are valid
            $admin = $result->fetch_assoc();
            $admin_email = $admin['email']; // Make sure this column exists in your table

            // Generate a random 6-digit OTP
            $otp = rand(100000, 999999);

            // Save OTP in the session and set a timestamp
            $_SESSION['dotp'] = $otp;
            $_SESSION['otp_timestamp'] = time();
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['doctor_username'] = $uname;

            // Send the OTP via email
            $subject = "Your Two-Step Verification Code";
            $message = "Dear Admin,\n\nYour OTP for logging into the WellCare Admin Panel is: $otp\n\nThis code will expire in 5 minutes.\n\nBest regards,\nGymPire Team";
            $headers = "From: no-reply@wellcare.com"; // Replace with your own email address

            if (mail($admin_email, $subject, $message, $headers)) {
                // Redirect to the OTP verification page
                header('Location: verify_otp.php');
                exit();
            } else {
                echo "<script>alert('Error sending OTP! Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials!');</script>";
        }
    } else {
        echo "<script>alert('Execution failed: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <img src="../images/wellcarelogo.png" alt="User Icon">
            </div>
            <form action="login.php" method="post">
                <input type="text" name="txtuname" placeholder="Username" class="input-field" required>
                <input type="password" name="txtpass" placeholder="Password" class="input-field" required>
                <button type="submit" name="loginbtn" class="btn">Login</button>
                <a href="forgot_password.php">Forgot Password</a>
            </form>
        </div>
    </div>
</body>
</html>
