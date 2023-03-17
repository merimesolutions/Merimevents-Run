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
			<div class="container-fluid pb-5" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;">
				<div class="cont">

				<div class="section-title">

					<h2 class="text-info">Privacy Policy</h2>
					<!-- <p>Here is how you can reach us</p> -->
				</div>
            </div>
				<div class="row" data-aos="fade-up" data-aos-duration="1000">
			         <div class="col-lg-12">
			         	<div class="card p-5">
			         		<div class="head_top">
			         			<h3>Privacy Policy</h3>
			         		</div>
			         		<div class="one">
			         			<h4>Personal Information</h4>
			         			<p><a href="https://merimevents-run.com/">Merimevents-run.com/</a> will collect and maintain personal information provided by its users, including their names, addresses, mobile telephone numbers, email addresses, and so forth. The amount of information provided by our users is completely voluntary; however, providing less information might limit a user’s ability to access all of the site’s features</p>
			         		</div>
			         		<!--  -->
			         		<div class="one">
			         			<h4>Sharing User Data</h4>
			         			<p>As a general policy, we use personal information and message data for internal purposes only. We do not sell or rent information about you. We will not disclose personal information or message data to third parties without your consent, except as explained in this Privacy Policy.</p>
			         		</div>
			         			<!--  -->
			         		<div class="one">
			         			<h4>Compliance with laws</h4>
			         			<p><a href="https://merimevents-run.com/">Merimevents-run.com/</a> cooperates with government and law enforcement officials to enforce and comply with the law. We may therefore disclose personal information, usage data, message data, and any other information about you, if we deem that it is reasonably necessary to: (a) satisfy any applicable law, regulation, legal process (such as a subpoena or court order), or enforceable governmental request; (b) enforce the Terms of Use, including investigation of potential violations thereof; (c) detect, prevent, or otherwise address fraud, security or technical issues; or (d) protect against harm to the rights, property or safety of the Company, its users or the public, as required or permitted by law.</p>
			         		</div>
			         			<!--  -->
			         		<div class="one">
			         			<h4>Security of your Data</h4>
			         			<p><a href="https://merimevents-run.com/">Merimevents-run.com/</a> will use necessary measures to protect the security of our client's data. However, it is important to note that it’s impossible for the company to completely guarantee that user data will be immune from malicious attack or compromise; as such, our clients should always be careful about disclosing confidential information.</p>
			         		</div>
			         		  			<!--  -->
			         		<div class="one">
			         			<h4>Updating Personal Information</h4>
			         			<p>Users of this platform can update, or change their personal information, or adjust or cease the frequency with which they receive company communications. They can also disable their account, in accordance with the Terms of Use.</p>
			         		</div>
			         			<!--  -->
			         		<div class="one">
			         			<h4>Changes to the Privacy Policy</h4>
			         			<p><a href="https://merimevents-run.com/">Merimevents-run.com/</a>  might make changes our privacy policy from time-to-time. Our clients should therefore periodically revisit the policy for any updates. We will make an effort to notify our users of any policy changes.You are therefore advised to subscribe to our newsletter so as to receive such notifications. In any case, users who continue to interact with the site following a revision of our privacy policy will automatically be subject to the new terms.</p>
			         		</div>
			         			<!--  -->
			         		<div class="one">
			         			<h4>NOTE:</h4>
			         			<p>You are urged to carefully protect any personal information submitted on the site — including passwords, company names, location, images, and videos — so that third parties can’t manipulate your accounts or assume your identities.Do not to disclose any sensitive information in the public domain.</p>
			         		</div>
			         		<!--  -->
			         		
			         	</div>
			         	
			         </div>
				</div>
 
			</div>
		</section><!-- End Contact Section -->


	</main><!-- End #main -->
	<footer class="bg-dark mt-5">
		<div class="container">
			<div class="row">
				<div class="small">
					<p class="text-center mt-3" style="color:white;"><em> &copy; Merime solutions <script type="text/javascript">var year = new Date();document.write(year.getFullYear());</script></em>    &nbsp;| &nbsp; <a href="privacy-policy">Privacy Policy</a></p>
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
