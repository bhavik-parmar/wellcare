<?php
session_start();
if (!isset($_SESSION['Doctor_logged_in'])) {
    header('Location: login.php');
    exit();
}
include('../dbconn.php');
$today_date = date('Y-m-d');
// Fetch count of approved appointments
$query_approved = "SELECT COUNT(*) AS approved_count FROM appoinment WHERE status = 'Accepted'";
$result_approved = mysqli_query($conn, $query_approved);
$row_approved = mysqli_fetch_assoc($result_approved);
$approved_count = $row_approved['approved_count']; // Store the approved count

// Fetch total number of appointments
$query_total = "SELECT COUNT(*) AS total_count FROM appoinment WHERE status='Completed'";
$result_total = mysqli_query($conn, $query_total);
$row_total = mysqli_fetch_assoc($result_total);
$total_count = $row_total['total_count']; // Store the total count

// Fetch number of meetings (assuming it's stored in a `meetings` table)
$query_approved_today = "SELECT COUNT(*) AS approved_today_count FROM appoinment 
                         WHERE status = 'approved' AND DATE(date) = '$today_date'";

$result_approved_today = mysqli_query($conn, $query_approved_today);
$row_approved_today = mysqli_fetch_assoc($result_approved_today);
$approved_today_count = $row_approved_today['approved_today_count']; // Store today's approved count

// Fetch number of clients (assuming clients are stored in a `clients` table)

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
      <a class="nav-link" href="index.html">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="appoinments.php">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Appoinments</span>
        
      </a>
     
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="records.php" >
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Medical Records</span>
        
      </a>
      <li class="nav-item">
      <a class="nav-link"  href="ApprovedAppoinment.php" >
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Approved Appoinment</span>
        
      </a>
      
    </li>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="medicins.php" >
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
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold"> Welcome, <?php echo htmlspecialchars($_SESSION['doctor_username']); ?>!</h3>
                    <h6 class="font-weight-normal mb-0">Doctor DashBoard</span></h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                  <div class="card-people mt-auto">
                    <img src="../images/doc.png" alt="people">

                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin transparent">
    <div class="row">
        <!-- Approved Appointments -->
        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
                <div class="card-body">
                    <p class="mb-4">Approved Appointments</p>
                    <p class="fs-30 mb-2"><?php echo $approved_count; ?></p> <!-- Dynamic value -->
                    
                </div>
            </div>
        </div>
        
        <!-- Total Appointments -->
        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Total Appointments</p>
                    <p class="fs-30 mb-2"><?php echo $total_count; ?></p> <!-- Dynamic value -->
                    
                </div>
            </div>
        </div>
    </div>
    


        <!-- Number of Clients -->
        <div class="col-md-6 stretch-card transparent">
            <div class="card card-light-danger">
                <div class="card-body">
                <p class="mb-4">Today's Approved Appointments</p>
            <p class="fs-30 mb-2"><?php echo $approved_today_count; ?></p> <!-- Dynamic value -->
            <p>Updated Today</p>
                </div>
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
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
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