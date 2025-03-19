<?php
include('../dbconn.php');

if (!isset($_GET['prescription_id'])) {
    echo "<p>No prescription found. Please go back and submit a prescription.</p>";
    exit();
}

$prescription_id = $_GET['prescription_id'];

// Fetch prescription details
$sql = "SELECT * FROM prescriptions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $prescription_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<p>No prescription found for this patient.</p>";
    exit();
}

$prescription = $result->fetch_assoc();

// Explode medicine details into arrays
$medicine_names = explode(",", $prescription['m_name']);
$medicine_eating = explode(",", $prescription['m_eating']);
$medicine_time = explode(",", $prescription['m_time']);
$medicine_durations = explode(",", $prescription['m_duration']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Case Paper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffffff;
            padding: 40px;
            max-width: 800px;
            margin: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            font-weight: bold;
            color: #000;
        }
        .divider {
            border-bottom: 3px solid red;
            margin: 10px 0;
        }
        .patient-info, .prescription-info {
            padding: 15px;
            border: 1px solid #ddd;
            margin-top: 10px;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: gray;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>WellCare Health Center</h2>
        <p>Ganesh Nagar, Kamla Chowk | Reg. No. REG/123456</p>
    </div>

    <p class="text-center"><i>Date: <?= date("d-M-Y", strtotime($prescription['date'])) ?></i></p>
    <div class="divider"></div>

    <div class="patient-info">
        <h5>Patient Details</h5>
        <p><strong>Name:</strong> <?= $prescription['p_name'] ?></p>
        <p><strong>DOB:</strong> <?= $prescription['date'] ?></p>
        <p><strong>Age:</strong> <?= $prescription['p_age'] ?> years</p>
        <p><strong>Gender:</strong> <?= $prescription['p_gender'] ?></p>
    </div>

    <div class="prescription-info">
    <h5>Prescription</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Medicine Details</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($medicine_names); $i++) { ?>
            <tr>
                <td>
                    <p><strong>Medicine Name:</strong> <?= trim($medicine_names[$i]) ?></p>
                    <p><strong>Dosage Time:</strong> <?= isset($medicine_time[$i]) ? trim($medicine_time[$i]) : '-' ?></p>
                    <p><strong>Duration:</strong> <?= isset($medicine_durations[$i]) ? trim($medicine_durations[$i]) : '-' ?></p>
                    <p><strong>Eating Instruction:</strong> <?= isset($medicine_eating[$i]) ? trim($medicine_eating[$i]) : '-' ?></p>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <h5>Advice</h5>
    <p><?= nl2br($prescription['d_notes']) ?></p>
</div>


    <div class="divider"></div>

    <div class="footer">
        <p><strong>Dr. Raval, MBBS</strong></p>
        <p>Contact: +91 9885623548 | Email: dr.mohit@gmail.com</p>
        <p><strong>Dr. Maheswari, MBBS</strong></p>
        <p>Contact: +91 9885623548 | Email: dr.mohit@gmail.com</p>
        <p><strong>Dr. Tripathi, MBBS</strong></p>
        <p>Contact: +91 9885623548 | Email: dr.mohit@gmail.com</p>
        <p><strong>Dr. Upadhyay, MBBS</strong></p>
        <p>Contact: +91 9885623548 | Email: dr.mohit@gmail.com</p>
    </div>

    <div class="text-center mt-3">
        <a href="download_pdf.php?prescription_id=<?= $prescription_id ?>" class="btn btn-primary">Download PDF</a>
        <button onclick="window.print()" class="btn btn-secondary">Print Case Paper</button>
        <a href="appoinments.php" class="btn btn-primary">Home</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
