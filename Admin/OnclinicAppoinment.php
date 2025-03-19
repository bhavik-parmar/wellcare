<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
include('../dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>WellCare Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
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
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="appoinments.php" >
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Appoinments</span>
        
      </a>
     
    </li>
    <li class="nav-item">
      <a class="nav-link" href="doctors.php" >
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Doctors</span>
        
      </a>
      
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="records.php" >
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Medical Records</span>
        
      </a>
      
    </li>
    <li class="nav-item">
      <a class="nav-link" href="OnclinicAppoinment.php" >
        <i class="icon-grid-2 menu-icon"></i>
        <span class="menu-title">Add Appoinment</span>
        
      </a>
      
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="reminder.php">
        <i class="icon-contract menu-icon"></i>
        <span class="menu-title">Reminder</span>
        
      </a>
      
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="users.php" >
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Users</span>
        
      </a>
      
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="medicins.php" >
        <i class="icon-ban menu-icon"></i>
        <span class="menu-title">Medicins</span>
        
      </a>
      
    </li>
   
  </ul>
</nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                 
                  
            
                  <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
				<div class="container mt-5">
    <h2 class="text-center">Book an Appointment</h2>
    <form action="OnclinicAppoinment.php" method="POST">
        <div class="mb-3">
            <label for="fname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fname" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="mb-3">
            <label for="doctor" class="form-label">Select Doctor</label>
            <select name="doctor_id" id="doctor_id" class="form-control form_control">
    <option value="">Select a Doctor</option>
    <?php
    $result = $conn->query("SELECT id, uname FROM doctor");

    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id']}'>{$row['uname']}</option>";
    }
    ?>
</select>
        </div>

        <div class="mb-3">
            <label for="msg" class="form-label">Message</label>
            <textarea class="form-control" id="msg" name="msg" rows="4" required></textarea>
        </div>

        <button type="submit" name="subbtn" class="btn btn-primary w-100">Add Appoinment</button>
    </form>
</div>

              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i></span>
  </div>
</footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <!-- <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script> -->
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/dataTables.select.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    

    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
  </body>
</html>


<?php 
// Include database connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $datepicker = trim($_POST['date']);
  $phone = trim($_POST['phone']);
  $doctor_id = trim($_POST['doctor_id']);
  $message = trim($_POST['msg']);

  // Validate required fields
  if (empty($name) || empty($email) || empty($datepicker) || empty($phone) || empty($doctor_id)) {
      echo "<script>alert('Please fill in all required fields!'); window.history.back();</script>";
      exit();
  }

  // Validate email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<script>alert('Invalid email format!'); window.history.back();</script>";
      exit();
  }

  // Insert into the database
  $sql = "INSERT INTO appoinment (fname, email, date, phone, doctor_id, msg) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  if ($stmt) {
      $stmt->bind_param("ssssis", $name, $email, $datepicker, $phone, $doctor_id, $message);

      if ($stmt->execute()) {
          echo "<script>alert('Appointment booked successfully!'); window.location.href = 'OnclinicAppoinment.php';</script>";
      } else {
          echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
      }

      $stmt->close();
  } else {
      echo "<script>alert('Error preparing SQL: " . $conn->error . "'); window.history.back();</script>";
  }

  $conn->close();
}
?>

