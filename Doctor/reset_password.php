<?php
include('../dbconn.php'); // Database connection

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    // Validate token
    $sql = "SELECT email, token_expiry FROM doctor WHERE reset_token='$token'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];
            $tokenExpiry = $row['token_expiry'];

            // Check if token has expired
            if (strtotime($tokenExpiry) > time()) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $newPassword = mysqli_real_escape_string($conn, $_POST['password']); // Get new password from form input

                    // Update password and clear token
                    $sql = "UPDATE doctor SET pass='$newPassword', reset_token=NULL, token_expiry=NULL WHERE reset_token='$token'";
                    if (mysqli_query($conn, $sql)) {
                        // Send confirmation email
                        $subject = "Password Reset Successful";
                        $message = "Hello,\n\nYour password has been successfully reset.\n\nIf you did not perform this action, please contact support immediately.\n\nBest Regards,\nYour Website Team";
                        $headers = "From: bhavikp12102@gmail.com\r\n";

                        mail($email, $subject, $message, $headers);

                        echo "Password has been reset! A confirmation email has been sent.";
                    } else {
                        echo "Error updating password.";
                    }
                }
            } else {
                echo "Token has expired!";
            }
        } else {
            echo "Token not found!";
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
} else {
    echo "Token missing!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-3">Reset Password</h3>
        <form method="post">
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Enter new password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
