<?php
session_start();
if (!isset($_SESSION['Doctor_logged_in'])) {
    header('Location: login.php');
    exit();
}
$doctor = $_SESSION['doctor_username'];

include('../dbconn.php');
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

// Fetch prescription data where the doctor's name matches the logged-in doctor
$query = "SELECT * FROM prescriptions WHERE doctor_id = '$doctor_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Wellcare Doctor</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <style>
    .table-responsive {
  overflow-x: auto;
  white-space: nowrap;
}
    </style>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo me-5" href="index.html"><img src="../images/wellcarelogo.png" class="me-2" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="logout.php" >
          <img src="../images/logout.png" alt="profile" />
        </a>
       
      </li>
          </ul>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="appoinments.php">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Appoinments</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="records.php">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Medical Records</span>
              </a>
            </li>
            <li class="nav-item">
      <a class="nav-link"  href="ApprovedAppoinment.php" >
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Approved Appoinment</span>
        
      </a>
      
    
    </li>
            <li class="nav-item">
              <a class="nav-link" href="medicins.php">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Medicins</span>
              </a>
            </li>
          </ul>
        </nav>

        <div class="main-panel">
          <div class="content-wrapper">
      <!-- Search Bar -->
 <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search Patient Name...">
                    </div>
                    <div style="overflow-x: auto; width: 100%;">
                      <table class="table table-striped" id="prescriptionTable">
                        <thead>
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Symptoms</th>
                            <th scope="col">Medicine Name</th>
                            <th scope="col">Dosage</th>
                            <th scope="col">Frequency</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Notes</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                              echo "<tr>";
                              echo "<td>" . $row['date'] . "</td>";
                              echo "<td>" . $row['p_name'] . "</td>";
                              echo "<td>" . $row['p_age'] . "</td>";
                              echo "<td>" . $row['p_gender'] . "</td>";
                              echo "<td>" . $row['p_email'] . "</td>";
                              echo "<td>" . $row['symptoms'] . "</td>";
                              echo "<td>" . $row['m_name'] . "</td>";
                              echo "<td>" . $row['m_time'] . "</td>";
                              echo "<td>" . $row['m_eating'] . "</td>";
                              echo "<td>" . $row['m_duration'] . "</td>";
                              echo "<td>" . $row['d_notes'] . "</td>";
                              echo "</tr>";
                            }
                          } else {
                            echo "<tr><td colspan='11'>No prescriptions found.</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>


            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i></span>
              </div>
            </footer>
          </div>
        </div>
      </div>
    </div>
    <script>
            document.getElementById("searchInput").addEventListener("keyup", function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#prescriptionTable tbody tr");

            rows.forEach(row => {
            let patientName = row.cells[1].textContent.toLowerCase();
            if (patientName.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
    </script>
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/dataTables.select.min.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
  </body>
</html>
