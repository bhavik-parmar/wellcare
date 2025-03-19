<?php
include('../dbconn.php'); // Database connection

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

   
    // Validate token
    $sql = "SELECT email, token_expiry FROM admin WHERE reset_token='$token'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $tokenExpiry = $row['token_expiry'];

            // Debugging: Show token expiry time
            echo "Token expiry time: $tokenExpiry <br>";

            // Check if token has expired
            if (strtotime($tokenExpiry) > time()) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $newPassword = $_POST['password']; // Encrypt password

                    // Update password and clear token
                    $sql = "UPDATE admin SET pass='$newPassword' WHERE reset_token='$token'";
                    mysqli_query($conn, $sql);

                    echo "Password has been reset!";
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
