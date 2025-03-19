<?php
// Include database connection
include 'dbconn.php';

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $password_repeat = $_POST['cpass']; 

    // Check if password and confirm password match
    if ($password !== $password_repeat) {
        echo "Passwords do not match.";
        exit();
    }

    // Prepare SQL query
    $sql = "INSERT INTO user_info (fname, lname, gender, dob, email, pass) 
            VALUES ('$first_name', '$last_name', '$gender', '$dob', '$email', '$password')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Success message and redirect
        echo "<script>
                alert('Registration successful!');
                window.location.href = 'page-login.html'; // Redirect to login page (or any other page you want)
              </script>";
    } else {
        // Display error if insertion fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    // Close connection
    $conn->close();
}
?>
