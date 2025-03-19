<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include('../dbconn.php');  // Include the database connection file

// Check if form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize and assign form data to variables
    $medicine_name = $_POST['medicine_name'];
    $manufacturer = $_POST['manufacturer'];
    $expiry_date = $_POST['expiry_date'];
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];

    // Prepare the SQL query using placeholders for values
    $query = "INSERT INTO medicines (m_name, m_manufacturer, m_expiry, m_quantity, m_price) 
              VALUES (?, ?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = mysqli_prepare($conn, $query)) {

        // Bind the form data to the placeholders in the query
        mysqli_stmt_bind_param($stmt, "sssss", $medicine_name, $manufacturer, $expiry_date, $quantity, $price);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success_message'] = "Medicine added successfully!";
            header('Location: medicins.php');  // Redirect to medicines list page
            exit();
        } else {
            // If the query fails, show an error message
            $_SESSION['error_message'] = "Error adding medicine: " . mysqli_error($conn);
            header('Location: add_medicine.php');  // Stay on the same page in case of error
            exit();
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle errors with preparing the query
        $_SESSION['error_message'] = "Error preparing statement: " . mysqli_error($conn);
        header('Location: add_medicine.php');
        exit();
    }
}
?>
