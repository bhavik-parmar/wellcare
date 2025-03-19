<?php
include('../dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['medicine_id'];
    $name = $_POST['medicine_name'];
    $manufacturer = $_POST['manufacturer'];
    $expiry_date = $_POST['expiry_date'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $query = "UPDATE medicines SET 
                m_name='$name', 
                m_manufacturer='$manufacturer', 
                m_expiry='$expiry_date', 
                m_quantity='$quantity', 
                m_price='$price' 
              WHERE id='$id'";

    if ($conn->query($query) === TRUE) {
        header("Location: medicins.php?success=updated");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
