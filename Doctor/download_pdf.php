<?php
ob_start(); // Start output buffering
require 'D:\xampp\htdocs\wellcare\dompdf\vendor\autoload.php'; // Ensure DomPDF is loaded
include('../dbconn.php');

use Dompdf\Dompdf;
use Dompdf\Options;

if (!isset($_GET['prescription_id'])) {
    die("Invalid request. Prescription ID is missing.");
}

$prescription_id = intval($_GET['prescription_id']); // Sanitize input

// Fetch the specific prescription
$sql = "SELECT * FROM prescriptions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $prescription_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Prescription not found.");
}

$prescription = $result->fetch_assoc();

// Initialize DomPDF
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$dompdf = new Dompdf($options);

// Build the HTML for the PDF
$html = '
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { font-weight: bold; }
        .divider { border-bottom: 2px solid red; margin: 10px 0; }
        .patient-info, .prescription-info { padding: 10px; border: 1px solid #ddd; margin-top: 10px; }
        .rx-symbol { font-size: 24px; font-weight: bold; color: red; }
        .footer { text-align: center; margin-top: 20px; font-size: 14px; color: gray; }
    </style>

    <div class="header">
        <h2>WellCare Health Center</h2>
        <p>Ganesh Nagar, Kamla Chowk | Reg. No. REG/123456</p>
    </div>

    <p style="text-align: center;"><i>Date: ' . date("d-M-Y", strtotime($prescription['date'])) . '</i></p>
    <div class="divider"></div>

    <div class="patient-info">
        <h4>Patient Details</h4>
        <p><strong>Name:</strong> ' . $prescription['p_name'] . '</p>
        <p><strong>Age:</strong> ' . $prescription['p_age'] . ' years</p>
        <p><strong>Gender:</strong> ' . $prescription['p_gender'] . '</p>

    </div>

    <div class="prescription-info">
        <h4> Prescription</h4>
        <p><strong>Medicines:</strong><br>' . nl2br($prescription['m_name']) . '</p>
        <h4>Investigations</h4>
        <p>' . nl2br($prescription['test']) . '</p>
        <h4>Advice / Referrals</h4>
        <p>' . nl2br($prescription['d_notes']) . '</p>
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
';

// Load the HTML content into DomPDF
$dompdf->loadHtml($html);

// Set paper size (A4)
$dompdf->setPaper('A4', 'portrait');

// Clean any extra output
ob_end_clean(); // Clean previous outputs

// Render the PDF
$dompdf->render();

// Output the generated PDF (force download)
$dompdf->stream("Prescription_" . $prescription_id . ".pdf", ["Attachment" => true]);

// Close database connection
$conn->close();
exit;
?>
