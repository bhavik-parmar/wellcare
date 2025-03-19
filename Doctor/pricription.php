
<?php


if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['email']) && isset($_GET['phone']) ) {
    $id = $_GET['id'];
    $name = $_GET['name'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
  
} else {
    echo "Required data not provided!";
}

include('../dbconn.php'); 

session_start();
if (!isset($_SESSION['Doctor_logged_in'])) {
    header('Location: login.php');
    exit();
}
$doctor = $_SESSION['doctor_username'];

$query = "SELECT id FROM doctor WHERE uname = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $doctor);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $doctor_id = $row['id'];
} else {
    $doctor_id = null; // Handle case where no doctor is found
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Prescription Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        padding-top: 50px;
    }

    .container {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-section {
        margin-bottom: 20px;
    }

    h2 {
        font-size: 28px;
        color: #343a40;
    }

    label {
        font-weight: bold;
        color: #495057;
    }

    .medicine-row {
        margin-top: 20px;
        padding: 15px;
        background-color: #f1f1f1;
        border-radius: 5px;
    }

    .submit-btn {
        background-color: #4CAF50;
        color: white;
        font-size: 18px;
        font-weight: bold;
        border: none;
        cursor: pointer;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center my-4">Doctor's Prescription Form</h2>
    
    <form id="prescription-form" action="addpricription.php" method="post" enctype="multipart/form-data">
        <div class="form-section">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="patient-name">Patient Name:</label>
                    <input type="text" id="patient-name" name="patient-name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="patient-age">Age:</label>
                    <input type="text" id="patient-age" name="patient-age" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="patient-gender">Gender:</label>
                    <select name="patient-gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <label for="symptoms">Symptoms:</label>
            <textarea id="symptoms" name="symptoms" rows="4" class="form-control" required></textarea>
        </div>

        <div class="form-section" id="medicines-section">
            <label>Medicines:</label><br>
            <button type="button" class="btn btn-info mt-3" id="add-medicine-btn">+ Add Another Medicine</button>
            
            <div class="medicine-row" id="medicine-row-1">
          
                    <div class="col-md-4">
                        <label for="medicine-name-1">Medicine 1 Name:</label>
                        <select id="medicine-name-1" name="medicine-name-1" class="form-control" >
                            <option value="">Select Medicine</option>
                            <?php
                            $sql = "SELECT id, m_name FROM medicines";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["m_name"] . "'>" . $row["m_name"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Dosage Timing (Checkbox) -->
                <div class="form-group">
                    <label>Dosage Time:</label><br>
                    <input type="checkbox" name="medicine-time-1[]" value="morning"> Morning
                    <input type="checkbox" name="medicine-time-1[]" value="afternoon"> Afternoon
                    <input type="checkbox" name="medicine-time-1[]" value="evening"> Evening
                </div>
                   <!-- Before/After Eating (Radio Button) -->
                <div class="form-group">
                    <label>When to Take:</label><br>
                    <input type="radio" name="medicine-eating-1" value="before eating" required> Before Eating
                    <input type="radio" name="medicine-eating-1" value="after eating"> After Eating
                </div>
               
                <div class="form-row mt-3">
                    <div class="col-md-4">
                        <label for="medicine-duration-1">Duration:</label>
                        <input type="text" id="medicine-duration-1" name="medicine-duration-1" class="form-control" >
                    </div>
                </div>
            </div>
            
        </div>

        <div class="form-section">
            <label for="doctor-notes">Doctor's Notes:</label>
            <textarea id="doctor-notes" name="doctor-notes" rows="4" class="form-control"></textarea>
        </div>
        <input type="hidden" name="doctor" value="<?php echo htmlspecialchars($doctor_id); ?>">
        <button type="submit" class="btn submit-btn w-100 mt-4">Submit Prescription</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let medicineCount = 1; // Track medicine count
    const addMedicineBtn = document.getElementById("add-medicine-btn");
    const medicinesSection = document.getElementById("medicines-section");

    addMedicineBtn.addEventListener("click", function () {
        medicineCount++;

        // Clone existing medicine row
        let newMedicineRow = document.createElement("div");
        newMedicineRow.classList.add("medicine-row");
        newMedicineRow.id = `medicine-row-${medicineCount}`;
        newMedicineRow.innerHTML = `
            <div class="col-md-4">
                <label for="medicine-name-${medicineCount}">Medicine ${medicineCount} Name:</label>
                <select id="medicine-name-${medicineCount}" name="medicine-name-${medicineCount}" class="form-control">
                    <option value="">Select Medicine</option>
                    <?php
                    $sql = "SELECT id, m_name FROM medicines";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["m_name"] . "'>" . $row["m_name"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <!-- Dosage Timing (Checkbox) -->
            <div class="form-group">
                <label>Dosage Time:</label><br>
                <input type="checkbox" name="medicine-time-${medicineCount}[]" value="morning"> Morning
                <input type="checkbox" name="medicine-time-${medicineCount}[]" value="afternoon"> Afternoon
                <input type="checkbox" name="medicine-time-${medicineCount}[]" value="evening"> Evening
            </div>
            <!-- Before/After Eating (Radio Button) -->
            <div class="form-group">
                <label>When to Take:</label><br>
                <input type="radio" name="medicine-eating-${medicineCount}" value="before eating" required> Before Eating
                <input type="radio" name="medicine-eating-${medicineCount}" value="after eating"> After Eating
            </div>
            <div class="form-row mt-3">
                <div class="col-md-4">
                    <label for="medicine-duration-${medicineCount}">Duration:</label>
                    <input type="text" id="medicine-duration-${medicineCount}" name="medicine-duration-${medicineCount}" class="form-control">
                </div>
            </div>
        `;

        medicinesSection.appendChild(newMedicineRow);
    });
});
</script>

</body>
</html>
