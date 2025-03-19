<?php
session_start();

if (!isset($_SESSION['otp'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['verifybtn'])) {
    $entered_otp = $_POST['otp'];
    $current_time = time();

    // Check if the OTP is valid
    if ($entered_otp == $_SESSION['otp'] && ($current_time - $_SESSION['otp_timestamp']) <= 300) {
        // OTP is valid and not expired
        unset($_SESSION['otp']); // Clear OTP from session
        unset($_SESSION['otp_timestamp']); // Clear OTP timestamp

        $_SESSION['admin_logged_in'] = true;

        // Redirect to the admin dashboard
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Invalid or expired OTP! Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <h2>Enter OTP</h2>
            <form action="verify_otp.php" method="post">
                <input type="text" name="otp" placeholder="Enter the OTP" class="input-field" required>
                <button type="submit" name="verifybtn" class="btn">Verify</button>
            </form>
        </div>
    </div>
</body>
</html>
