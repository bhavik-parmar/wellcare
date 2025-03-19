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
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
          <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
            <span class="input-group-text" id="search">
              <i class="icon-search"></i>
            </span>
          </div>
          <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
      </li>
    </ul>
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
      <a class="nav-link"  href="appoinments.php"  >
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Appoinments</span>
        
      </a>
     
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="doctors.php" >
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Doctors</span>
        
      </a>
      
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="records.php"  >
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
      <a class="nav-link"  href="reminder.php"  >
        <i class="icon-contract menu-icon"></i>
        <span class="menu-title">Reminder</span>
        
      </a>
      
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="users.php"  >
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Users</span>
        
      </a>
      
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="medicins.php"  >
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
            <div class="text-end mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMedicineModal">
        Add Medicine
    </button>
</div>

<!-- Add Medicine Modal -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMedicineModalLabel">Add Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_medicine.php" method="POST" class="needs-validation" novalidate>
                    <!-- Medicine Name -->
                    <div class="mb-3">
                        <label for="medicine_name" class="form-label">Medicine Name</label>
                        <input type="text" class="form-control" id="medicine_name" name="medicine_name" required>
                        <div class="invalid-feedback">Please enter a medicine name.</div>
                    </div>

                    <!-- Manufacturer -->
                    <div class="mb-3">
                        <label for="manufacturer" class="form-label">Manufacturer</label>
                        <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
                        <div class="invalid-feedback">Please enter manufacturer details.</div>
                    </div>

                    <!-- Expiry Date -->
                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
                        <div class="invalid-feedback">Please select an expiry date.</div>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                        <div class="invalid-feedback">Please enter a valid quantity.</div>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (₹)</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        <div class="invalid-feedback">Please enter the price.</div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Add Medicine</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Search Bar -->
<div class="mb-3">
<input type="text" id="searchInput" class="form-control" placeholder="Search Medicines Name...">

                    </div>
<div class="card-body">
                                <p class="card-title">Medicines</p>
                                <div class="table-responsive">
                                    <table id="example" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Manufacturer</th>
                                                <th>Expiry_Date</th>
                                                <th>Qantity</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="medicinesTable">

                                            <?php
                                            $query = "SELECT * FROM medicines ORDER BY m_name ASC";

                                            $result = $conn->query($query);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<tr>
                                                        <td>'.$row["id"].'</td>
                                                        <td>'.$row["m_name"].'</td>
                                                        <td>'.$row["m_manufacturer"].'</td>
                                                        <td>'.$row["m_expiry"].'</td>
                                                        <td>'.$row["m_quantity"].'</td>
                                                        <td>'.$row["m_price"].'</td>
                                                        <td>
                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm edit-btn" 
                        data-id="'.$row["id"].'" 
                        data-name="'.$row["m_name"].'" 
                        data-manufacturer="'.$row["m_manufacturer"].'"
                        data-expiry="'.$row["m_expiry"].'"
                        data-quantity="'.$row["m_quantity"].'"
                        data-price="'.$row["m_price"].'"
                        data-bs-toggle="modal" data-bs-target="#editMedicineModal">
                        <i class="fa fa-pencil"></i> Edit
                    </button>
                    
                    <!-- Delete Button -->
                    <button class="btn btn-danger btn-sm delete-btn" 
                        data-id="'.$row["id"].'">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </td>
                                                    </tr>';
                                                }
                                            } else {
                                                echo "<tr><td colspan='9'>No Medicins found.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                        <div class="modal fade" id="editMedicineModal" tabindex="-1" aria-labelledby="editMedicineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMedicineModalLabel">Edit Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="edit_medicine.php" method="POST">
                    <input type="hidden" id="edit_medicine_id" name="medicine_id">

                    <div class="mb-3">
                        <label for="edit_medicine_name" class="form-label">Medicine Name</label>
                        <input type="text" class="form-control" id="edit_medicine_name" name="medicine_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_manufacturer" class="form-label">Manufacturer</label>
                        <input type="text" class="form-control" id="edit_manufacturer" name="manufacturer" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_expiry_date" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" id="edit_expiry_date" name="expiry_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="edit_quantity" name="quantity" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Price (₹)</label>
                        <input type="number" class="form-control" id="edit_price" name="price" step="0.01" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Medicine</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("medicinesTable");
    const rows = tableBody.getElementsByTagName("tr");

    searchInput.addEventListener("keyup", function () {
        const searchText = searchInput.value.toLowerCase();

        for (let row of rows) {
            const medicineName = row.cells[1]?.textContent.toLowerCase() || ""; // Get Medicine Name
            if (medicineName.includes(searchText)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    });
});
</script>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    
    <script>
document.addEventListener("DOMContentLoaded", function () {
    // Select all delete buttons
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            let medicineId = this.getAttribute("data-id");

            // Show confirmation popup
            if (confirm("Are you sure you want to delete this medicine?")) {
                // Redirect to delete script
                window.location.href = "delete_medicine.php?id=" + medicineId;
            }
        });
    });
});
</script>
<script>
    // Bootstrap Form Validation
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Select all edit buttons
        const editButtons = document.querySelectorAll(".edit-btn");

        editButtons.forEach(button => {
            button.addEventListener("click", function () {
                // Get data attributes from clicked button
                let id = this.getAttribute("data-id");
                let name = this.getAttribute("data-name");
                let manufacturer = this.getAttribute("data-manufacturer");
                let expiry = this.getAttribute("data-expiry");
                let quantity = this.getAttribute("data-quantity");
                let price = this.getAttribute("data-price");

                // Set values in the modal form
                document.getElementById("edit_medicine_id").value = id;
                document.getElementById("edit_medicine_name").value = name;
                document.getElementById("edit_manufacturer").value = manufacturer;
                document.getElementById("edit_expiry_date").value = expiry;
                document.getElementById("edit_quantity").value = quantity;
                document.getElementById("edit_price").value = price;
            });
        });
    });
</script>
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