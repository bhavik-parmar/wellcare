<?php
include('../dbconn.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM medicines WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: medicins.php?msg=deleted");
    } else {
        header("Location: medicins.php?msg=error");
    }

    $stmt->close();
    $conn->close();
}
?>
