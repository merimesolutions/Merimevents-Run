<?php
if(isset($_POST['send'])){
    

	$name=$_POST['name'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	
	//Validate Email
	$email =$_POST['email'];
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   $emailErr = "Invalid email format";
} 
	if(empty($emailErr)){
	             
$mail='help@merimevents-run.com';
$email_from = $email;   // sender address
$email_subject = "INQUIRY: $subject";
$email_body = "Dear Merimevents-run $name left you the following message:,\n $message\n
".
$to = "To: $mail";// receiving addresss
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $email \r\n";
//Send the email!
$y=mail($to,$email_subject,$email_body,$headers);

if($y){
 echo '<script type="text/javascript">'; 
    echo 'alert("Your Message has been sent to Merime events help center.A reply will be sent to you as soon as possible.");'; 
    echo 'window.location = "#";';
    echo '</script>';
}
	}else{
	 echo '<script type="text/javascript">'; 
    echo 'alert("An Error occured during submision:'."$emailErr".'");'; 
    echo 'window.location = "#";';
    echo '</script>'; 
	}
	
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Merime Events-run</title>
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
		<section id="contact" class="contact">
			<div class="container">

				<div class="section-title">

					<h2 class="text-info">Contact Us</h2>
					<p>Here is how you can reach us</p>
				</div>

				<div class="row" data-aos="fade-up" data-aos-duration="1000">
					<div class="col-lg-6">
						<div class="info-box mb-4">
							<i class="bx bx-map"></i>
							<h3>Our Address</h3>
							<p>2nd Floor Kilifi Plaza,
								P.O. Box 726 - 80108,
								<br>
								Kilifi Town, Kilifi County
								Kenya.
							</p>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="info-box  mb-4">
							<i class="bx bx-envelope"></i>
							<h3>Email Us</h3>
							<p><a href="mailto:help@merimevents-run.com">help@merimevents-run.com</a></p>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="info-box  mb-4">
							<i class="bx bx-phone-call"></i>
							<h3>Call Us</h3>

							<p><a href="tel: +254757414345">+254757414345</a>

							</p>
						</div>
					</div>

				</div>

				<div class="row" data-aos="fade-up" data-aos-duration="2000">

					<div class="col-lg-6 ">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.8110551246477!2d39.852339343155094!3d-3.6305785436984683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x183fdd863f78d81d%3A0x850eca2e1cfc963b!2sKilifi%20Plaza!5e0!3m2!1sen!2ske!4v1624868490017!5m2!1sen!2ske" width="550" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
					</div>

					<div class="col-lg-6">
						<form action="" method="post">

							<div class="row">
								<div class="col-md-6 form-group">


									<input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>

								</div>
								<div class="col-md-6 form-group mt-3 mt-md-0">
									<input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
								</div>
							</div>
							<div class="form-group mt-3">
								<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
							</div>
							<div class="form-group mt-3">
								<textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
							</div>

							<div class="text-center mt-3"><button type="submit" name="send" class="btn btn-danger rounded"  > Send Message</button></div>
						</form>
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
