<?php
  $mysqli= mysqli_connect('localhost','merimeve_event','user@event','merimeve_event');


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Merime Events-run - Portfolion</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="../themes/images/merimevents.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--Font Awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Vendor CSS Files -->
	<link href="hir/assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="hir/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="hir/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="hir/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="hir/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="hir/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="hir/assets/css/style.css" rel="stylesheet">
	<style type="text/css">
		.portfolio .cont{
			/*background-image: url('hir/images/portfolio.jpg');*/
		}
		.port{
		  transition:0.8s;
		  border-radius:10px;
			box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;
		}
		.port:hover{
			cursor:pointer;
        border-radius:0px;
       transform: translateY(-10px);
		}
	</style>


</head>

<body>

	<!-- ======= Top Bar ======= -->
	<section id="topbar" class="d-flex align-items-center">
		<div class="container d-flex justify-content-center justify-content-md-between">
			<div class="contact-info d-flex align-items-center">
				<i class="bi bi-envelope-fill"></i><a href="mailto:help@merimevents-run.com">help@merimevents-run.com</a>
				<i class="bi bi-phone-fill phone-icon"></i><a href="tel: +254757414345">+254757414345</a>
			</div>
			<div class="social-links d-none d-md-block">
				<a href="https://merimesolutions.com" class="twitter"><i class="fas fa-globe"></i></a>
				<a href="https://m.facebook.com/merimeventsrun/" class="facebook"><i class="bi bi-facebook"></i></a>
				<a href="https://instagram.com/merime_solutions?igshid=xwh3mkw8k2ds" class="instagram"><i class="bi bi-instagram"></i></a>
				<a href="https://www.linkedin.com/company/merimeke" class="linkedin"><i class="bi bi-linkedin"></i></a>
			</div>
		</div>
	</section>

	<!-- ======= Header ======= -->
	<header id="header" class="d-flex align-items-center">
		<div class="container d-flex align-items-center justify-content-between">

			<h1 class="logo" style="text-transform:none!important;"><a>Merime Events-run</a></h1>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

			<nav id="navbar" class="navbar">
				<ul>
					<li><a class="nav-link" href="https://merimevents-run.com" active>Home</a></li>
					<li class="dropdown"><a href="#"><span>Register</span> <i class="bi bi-chevron-down"></i></a>
						<ul>
							<li><a href="free-trial">Free Trial</a></li>
							<li><a href="hir/register">Paid Membership</a>
							</li>
						</ul>

					<li><a class="nav-link" href="hir/login">Login</a></li>
					<li><a class="nav-link" href="demo">Demo</a></li>
					<li><a class="nav-link" href="portfolio">Portfolio</a></li>
					<li><a class="nav-link" href="price">Pricing Plans</a></li>
					<li><a class="nav-link active" href="contact"> Contact </a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->

		</div>
	</header><!-- End Header -->

	<main>

		<!-- ======= Contact Section ======= -->
		<section id="contact" class="contact portfolio">
			<div class="container-fluid">
				<div class="cont">

				<div class="section-title">

					<h2 class="text-info">Our Portfolio</h2>
					<!-- <p>Here is how you can reach us</p> -->
				</div>
            </div>
				<div class="row" data-aos="fade-up" data-aos-duration="1000">
			 
          
					   <div class="col-lg-2">
					   	<a href="#" target="_blank">
						<div class="card port d-flex" style="height:100%">
						<img src="hir/hip/logos/" class="img-fluid" alt="Company logo">

							<h4 class="p-3 mt-auto ">Tripple S event  </h4>
						</div>
					 </a>
					   </div>
					   <div class="col-lg-2">
					   	<a href="https://kenyaconferencesolutions.com/" target="_blank">
						<div class="card port d-flex" style="height:100%">
						<img src="hir/hip/logos/KCS-LOGO.jpg" class="img-fluid" alt="Company logo">

							<h4 class="p-3 mt-auto ">Kenya Conference Solutions  </h4>
						</div>
					</a>
					   </div> 
				</div>
 
			</div>
		</section><!-- End Contact Section -->


	</main><!-- End #main -->
	<footer class="bg-dark mt-5">
		<div class="container">
			<div class="row">
				<div class="small">
					<p class="text-center mt-3" style="color:white;"><em> &copy; Merime solutions <script type="text/javascript">var year = new Date();document.write(year.getFullYear());</script></em>
						&nbsp;| &nbsp; <a href="privacy-policy">Privacy Policy</a>
					</p>
				</div>
			</div>
		</div>
	</footer>



	<!-- Vendor JS Files -->
	<script src="hir/assets/vendor/aos/aos.js"></script>
	<script src="hir/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="hir/assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="hir/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="hir/assets/vendor/php-email-form/validate.js"></script>
	<script src="hir/assets/vendor/swiper/swiper-bundle.min.js"></script>

	<!-- Template Main JS File -->
	<script src="hir/assets/js/main.js"></script>

</body>

</html>
