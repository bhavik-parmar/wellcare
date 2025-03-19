
<?php
session_start();
if (!isset($_SESSION['doctor_username'])) {
    header('Location: login.php');
    exit();
}

include('../dbconn.php');

$username = $_SESSION['doctor_username']; // Fetching the doctor's username from session

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
      <a class="nav-link"  href="records.php" >
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
                    <!-- Search Bar -->
                    <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search Patient Name...">
                    </div>
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Appointments</p>
                                <div class="table-responsive">
                                    <table id="example" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                               
                                                <th>Time & Date</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT a.* FROM appoinment a
                                            JOIN doctor d ON a.doctor_id = d.id
                                            WHERE d.uname = ? AND a.status = 'Accepted'
                                            ORDER BY a.id DESC");
                                            $stmt->bind_param("s", $username);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                    

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<tr>
                                                        <td>'.$row["id"].'</td>
                                                        <td>'.$row["fname"].'</td>
                                                        <td>'.$row["email"].'</td>
                                                        <td>'.$row["phone"].'</td>
                                                        
                                                        <td>'.$row["date"].'</td>
                                                        <td>'.$row["msg"].'</td>
                                                        <td>'.$row["status"].'</td>
                                                        <td>
                                                      <button class="btn btn-success btn-sm approve-btn" data-id="'.$row["id"].'" data-email="'.$row["email"].'" data-name="'.$row["fname"].'" data-date="'.$row["date"].'">Approve</button>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm cancel-btn" onclick="confirmCancel('.$row["id"].')">Cancel</a>

                                                      </td>

                                                    </tr>';
                                                }
                                            } else {
                                                echo "<tr><td colspan='9'>No approved appointments found.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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
    <script>
  document.getElementById("searchInput").addEventListener("keyup", function () {
      let filter = this.value.toLowerCase();
      let rows = document.querySelectorAll("#example tbody tr");

      rows.forEach(row => {
          let name = row.cells[1].textContent.toLowerCase(); // Assuming name is in the second column (index 1)
          if (name.includes(filter)) {
              row.style.display = "";
          } else {
              row.style.display = "none";
          }
      });
  });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $(".approve-btn").click(function () {
      let appointmentId = $(this).data("id");
      let email = $(this).data("email");
      let name = $(this).data("name");
      let date = $(this).data("date");

      if (confirm("Are you sure you want to approve this appointment?")) {
        $.ajax({
          type: "POST",
          url: "approveappoinment.php",
          data: {
            appointment_id: appointmentId,
            email: email,
            name: name,
            date: date,
          },
          success: function (response) {
            if (response.trim() === "success") {
              alert("Appointment approved successfully!");
              location.reload(); // Refresh the page
            } else {
              alert("Error: " + response);
            }
          },
          error: function () {
            alert("An error occurred while processing your request.");
          },
        });
      }
    });
  });

  function confirmCancel(id) {
    if (confirm("Are you sure you want to cancel this appointment?")) {
        window.location.href = "cancel_appointment.php?id=" + id;
    }
}

</script>

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





