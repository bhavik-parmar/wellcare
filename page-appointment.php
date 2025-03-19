<?php
// Start the session
session_start();
include('dbconn.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: page-login.html");
    exit();
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="ambulance, beauty, clinic, corporate, creative, cosmetic, dental, dentist, doctor, family gynecology, gynecology, health care, health & care, hospital, medical, medical template, pediatric, plastic surgery, skin care, surgeon, retail">
<meta name="unlockdesign" content="SaniulHassan">
<!-- css file -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/all-plugins.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/theme-color.css">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="css/responsive.css">
<!-- Title -->
<title>WellCare</title>
<!-- Favicon -->
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper">
	<div id="preloader" class="preloader">
		<div id="pre" class="preloader_container"><div class="preloader_disabler btn btn-default">Disable Preloader</div></div>
	</div>
	<header class="header-nav">
    <div class="main-header-nav navbar-scrolltofixed">
        <div class="container ulockd-p0">
            <nav class="navbar navbar-default bootsnav menu-style1">
                <!-- Start Top Search -->
                <div class="top-search">
                    <div class="container">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-addon close-search"><i class="fa fa-times color-white"></i></span>
                        </div>
                    </div>
                </div>
                <!-- End Top Search -->

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand ulockd-main-logo2" href="#brand">
                        <img src="images/wellcarelogo.png" class="logo logo-scrolled" alt="">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-left" data-in="fadeIn">
                        <li class="dropdown">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="dropdown">
                            <a href="doctor.html">Doctors</a>
                        </li>
                        <li class="dropdown">
                            <a href="page-service.html">Service</a>
                        </li>
                        
                        <li class="dropdown">
                            <a href="page-appointment.php">Appointment</a>
                        </li>
                        
                        <!-- New Dropdown Menu -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="doctor.html">Doctors</a></li>
                                <li><a href="page-service.html">Service</a></li>
                                <li><a href="page-appointment.php">Appointment</a></li>
                                <li><a href="page-login.html">Login</a></li>
                                <li><a href="page-register.html">Register</a></li>
								<li><a href="userdata.php">User</a></li>
								<li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>      
</header>

	<!-- Home Design Inner Pages -->
	

	<!-- Home Design Inner Pages -->
	<div class="ulockd-inner-page">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="ulockd-icd-layer">
						<ul class="list-inline ulockd-icd-sub-menu">
							<li><a href="#"> HOME </a></li>
							<li><a href="#"> > </a></li>
							<li> <a href="#"> APPOINTMENT </a> </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Our About -->
	<section class="ulockd-about-one inner">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="about-box text-center">
						<img class="img-responsive img-whp" src="images/apoinment.png" alt="1.png">
						<h2 class="ulockd-about-thumb-ttl">Expert's From <span class="text-thm">The WellCare's </span></h2>
						<p>Make an appointment with our Doctors's and solved your health care solution.</p>
					</div>
				</div>
				<div class="col-md-12 col-md-6">
					<!-- Appointment Form Starts -->
		            <form class="appointment_form text-center" action="addappoinment.php" method="post">
		                <div class="row">
			                <div class="col-sm-12">
			                	<h3>Appointment with Doctor</h3>
					        	<p>Let's Appointment With our Doctors Who Try to Solved Your Problem.</p>
			                </div>
			                <div class="col-sm-12">
			                    <div class="form-group">
			                        <input type="text" class="form-control form_control" name="name" id="name" placeholder="Enter Name">
			                    </div>
			                </div>
			                <div class="col-sm-12">
			                    <div class="form-group">
			                        <input type="email" class="form-control form_control" name="email" id="email" placeholder="Enter Email">
			                    </div>
			                </div>
			                <div class="col-sm-6">
			                    <div class="form-group">
			                        <input type="text" class="form-control form_control datepicker" name="datepicker" id="datepicker" placeholder="Time & Date">
			                    </div>
			                </div>
			                <div class="col-sm-6">
								<div class="form-group">
									<input type="text" class="form-control form_control" name="phone" id="phone" placeholder="Enter A Phone" 
										pattern="\d{10}" title="Enter exactly 10 digits" maxlength="10" required>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
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
</div>

			                <div class="col-sm-12">
			                    <div class="form-group">
			                        <textarea class="form-control ulockd-form-tb" name="message" id="" cols="30" rows="5" placeholder="Write Message"></textarea>
			                    </div>
			                   
			                    <input type="submit" class="btn btn-default btn-thm ulockd-mb15" id="submit" value="Book Appoinment" name="appoinmentbtn">
				                <div id="alert"></div>
			                </div>
		                </div>
		            </form>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Funfact -->
	<section class="parallax ulockd_bgi1 overlay-tc85" data-stellar-background-ratio="0.3">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-3">
					<div class="ulockd-ffact-one text-center">
						<span class="flaticon-medical-11"></span>
                        <p class="color-white">Total Doctor's</p>
                        <div class="timer color-white">2860</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3">
					<div class="ulockd-ffact-one text-center">
						<span class="flaticon-medal-1"></span>
                        <p class="color-white">Total Awards</p>
                        <div class="timer color-white">1180</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3">
					<div class="ulockd-ffact-one text-center">
						<span class="flaticon-square"></span>
                        <p class="color-white">Clinical Services</p>
                        <div class="timer color-white">85</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3">
					<div class="ulockd-ffact-one text-center">
						<span class="flaticon-multiple-users-silhouette"></span>
                        <p class="color-white">Happy Patients</p>
                        <div class="timer color-white">11750</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Testimonials -->
	
	
	<!-- Our Footer -->
	<section class="ulockd-footer ulockd-p0">
		<div class="container footer-padding">
	
				
					<div class="ulockd-footer-widget">
    					<img alt="" src="images/wellcarelogo.png" class="img-responsive ulockd-footer-log">
    					<p class="ulockd-ftr-text">Regardless of whether you need to stay in your own house, are searching for help with a more established relative, looking for exhortation on paying for development, we can help you.</p>
    					<ul class="list-unstyled">
    						<li><a href="#"><span class="fa fa-phone text-thm"></span> +99-55-66-88-526</a> </li>
    						<li><a href="#"><span class="fa fa-envelope text-thm"></span> dummy2@yourmail.com</a> </li>
    						<li><a href="#"><span class="fa fa-map-signs text-thm"></span> Victoria 8007 Australia Envato HQ 121 King Street, Melbourne.</a></li>
    					</ul>
    				</div>
					<ul class="list-inline footer-font-icon ulockd-mt20">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-feed"></i></a></li>
						<li><a href="#"><i class="fa fa-google"></i></a></li>
						<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
					</ul>
				
				
		<div class="ulockd-copy-right">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="color-white">WellCare's Copyright©. <a href="https://1.envato.market/jB44v" target="_blank">UnlockDesign</a> All right reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

<a class="scrollToHome" href="#"><i class="fa fa-home"></i></a>
</div>
<!-- Wrapper End -->
<script>
    document.getElementById("phone").addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10); // Restrict to 10 digits
        }
    });
</script>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootsnav.js"></script>
<script src="js/parallax.js"></script>
<script src="js/scrollto.js"></script>
<script src="js/jquery-scrolltofixed-min.js"></script>
<script src="js/jquery.counterup.js"></script>
<script src="js/gallery.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/slider.js"></script>
<script src="js/video-player.js"></script>
<script src="js/jquery.chart.js"></script>
<script src="js/timepicker.js"></script>
<script src="js/tweetie.js"></script>
<!-- Form Script Link Start -->
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<script src="js/form-scripts/validation/dist/jquery.validate.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js?render=6LenStUZAAAAADFndFfBZsTzYmSJIwIrnpscPQ2f"></script>
<script src="js/form-scripts/appointment.js"></script>
<!-- Form Script Link End -->
<!-- Custom script for all pages --> 
<script src="js/script.js"></script>
</body>
</html>