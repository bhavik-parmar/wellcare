<?php
include('../dbconn.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = bin2hex(random_bytes(50)); // Generate secure token
    $expiry = date("Y-m-d H:i:s", strtotime('+5 minutes')); // Token valid for 5 minutes


    // Check if email exists
    $sql = "SELECT id FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Update token in DB
        $sql = "UPDATE admin SET reset_token='$token', token_expiry='$expiry' WHERE email='$email'";
        mysqli_query($conn, $sql);

        // Send email with reset link
        $resetLink = "http://localhost/wellcare/Admin/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click here to reset your password (valid for 5 minutes): $resetLink";
        $headers = "From: bhavikp12102@gmail.com\r\n";

        mail($email, $subject, $message, $headers);
        echo "Password reset link sent!";
    } else {
        echo "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-3">Forgot Password</h3>
        <p class="text-muted text-center">Enter your email to receive a password reset link.</p>
        <form method="post">
            <div class="mb-3">
               
                <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
            </div>
            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
