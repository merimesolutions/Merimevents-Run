<?php
if(isset($_POST['send'])){
$emailErr="";
	$name=$_POST['name'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	
	//Validate Email
	$email = trim($_POST['email']);
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

	<title>Merime Events-run | Planning and Management of events</title>
	<meta name="description" content="Planning and Management of events and Tasks made easier. You can manage and track hired out items from anywhere and anytime">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="../themes/images/merimevents.png" />
	<link href="../themes/images/merimevents.png" rel="icon">

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
	<!--Bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- Place your stylesheet here-->
	<!-- Template Main CSS File -->
	<link href="hir/assets/css/style.css" rel="stylesheet">


	<!-- =======================================================
  * Template Name: Day - v4.1.0
  * Template URL: https://bootstrapmade.com/day-multipurpose-html-template-for-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->



	<style>
		#wrapper::-webkit-scrollbar {
			display: none;
		}

		.service .card {
			height: 100%;
		}

		.card:hover {
			-webkit-box-shadow: -1px 9px 40px 12px rgba(0, 0, 0, 0.75);
			-moz-box-shadow: -1px 9px 40px 12px rgba(0, 0, 0, 0.75);
			box-shadow: -1px 9px 40px 12px rgba(0, 0, 0, 0.75);


		}

		.product-boxx {
			height: 100%;
		}

		.call {
			display: none;
		}

		.call-btn:hover+.call {
			display: block;
		}

		.info-box:hover {
			-webkit-box-shadow: -1px 9px 40px 12px rgba(0, 0, 0, 0.75);
			-moz-box-shadow: -1px 9px 40px 12px rgba(0, 0, 0, 0.75);
			box-shadow: -1px 9px 40px 12px rgba(0, 0, 0, 0.75);


		}

		/* The element to apply the animation to */
		.bat {

			animation-name: example;
			animation: example 1s infinite;
			animation-duration: 1s;
			font-size: 20px;
			text-transform: uppercase;
		}

		/* The animation code */
		@keyframes example {
			from {
				color: red;

				font-size: 20px;
			}

			to {
				color: navy;

				font-size: 20px
			}
		}

		#heroo {
			width: 100%;
			height: 100%;
			background: url('hir/img/abstract.jpg');
		}

		#heroo .container-fluid {
			padding-top: 72px;

		}

		#heroo h1 {
			margin: 0 0 10px 0;
			font-size: 48px;
			font-weight: 700;
			line-height: 56px;
			color: #fff;
		}

		#heroo h2 {
			color: rgba(255, 255, 255, 0.6);
			margin-bottom: 50px;
			font-size: 24px;
		}

		#heroo .btn-get-started {
			font-family: "Jost", sans-serif;
			font-weight: 500;
			font-size: 16px;
			letter-spacing: 1px;
			display: inline-block;
			padding: 10px 28px 11px 28px;
			border-radius: 50px;
			transition: 0.5s;
			margin: 10px 0 0 0;
			color: #fff;
			background: #47b2e4;
		}

		#heroo .btn-get-started:hover {
			background: #209dd8;
		}

		#heroo .btn-watch-video {
			font-size: 16px;
			display: inline-block;
			padding: 10px 0 8px 40px;
			transition: 0.5s;
			margin: 10px 0 0 25px;
			color: #fff;
			position: relative;
		}

		#heroo .btn-watch-video i {
			color: #fff;
			font-size: 32px;
			position: absolute;
			left: 0;
			top: 7px;
			transition: 0.3s;
		}

		#heroo .btn-watch-video:hover i {
			color: #47b2e4;
		}

		#heroo .animated {
			animation: up-down 2s ease-in-out infinite alternate-reverse both;
		}

		@media (max-width: 991px) {
			#heroo {
				height: 100vh;
				text-align: center;
			}

			#heroo.animated {
				-webkit-animation: none;
				animation: none;
			}

			#heroo .hero-img {
				text-align: center;
			}


		}
		}

		@media (max-width: 768px) {
			#heroo h1 {
				font-size: 28px;
				line-height: 36px;
			}

			#heroo h2 {
				font-size: 18px;
				line-height: 24px;
				margin-bottom: 30px;
			}

			#heroo .hero-img img {
				width: 70%;


			}
		}

		@media (max-width: 575px) {
			#heroo .hero-img img {
				width: 80%;
			}

			#heroo .btn-get-started {
				font-size: 16px;
				padding: 10px 24px 11px 24px;
			}

			#heroo .btn-watch-video {
				font-size: 16px;
				padding: 10px 0 8px 40px;
				margin-left: 20px;
			}

			#heroo .btn-watch-video i {
				font-size: 32px;
				top: 7px;
			}
		}

		@-webkit-keyframes up-down {
			0% {
				transform: translateY(10px);
			}

			100% {
				transform: translateY(-10px);
			}
		}

		@keyframes up-down {
			0% {
				transform: translateY(10px);
			}

			100% {
				transform: translateY(-10px);
			}
		}

		#preloader h5 {
			position: absolute;
			margin-top: 60vh;
			left: 0;
			right: 0;
			z-index: 9999;
			overflow: hidden;
			color: black;
			font-family: fangsong;
			font-weight: 700;
			text-align: center;
		}

		.by {
			height: 60vh !important;
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

			<span class="logo" style="text-transform:none!important;"><a>Merime Events-run</a></span>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

			<nav id="navbar" class="navbar">
				<ul>
					<li><a class="nav-link active" href="https://merimevents-run.com/" active>Home</a></li>
					<li class="dropdown"><a href="#"><span>Register</span> <i class="bi bi-chevron-down"></i></a>
						<ul>
							<li><a href="free-trial">Free Trial</a></li>
							<li><a href="hir/register">Paid Membership</a>
							</li>
						</ul>

					<li><a class="nav-link" href="https://merimevents-run.com/hir/login">Login</a></li>
					<li><a class="nav-link" href="https://merimevents-run.com/demo">Demo</a></li>
					<li><a class="nav-link" href="https://merimevents-run.com/portfolio">Portfolio</a></li>
					<li><a class="nav-link" href="https://merimevents-run.com/price">Pricing Plans</a></li>
					<li><a class="nav-link" href="https://merimevents-run.com/contact"> Contact </a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->

		</div>
	</header><!-- End Header -->
	<!-- ======= Hero Section ======= -->
	<section id="heroo" class="d-flex align-items-center">

		<div class="container">
			<div class="row">
				<div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
					<p style="font-size:20px;">
						<span class="text-primary fw-bold h3">Merime Events-run for you</span><br>
						<span class="text-danger fw-bold h4">Planning and Management of events and Tasks made easier.</span><br>
						<span class="text-danger fw-bold h4">The system's core functions include</span><br>
						1. Event Planning - The event planning module that lets you outline future events, plan, manage, and assign tasks to different parties involved. <br>
						<br><span>2. Items hiring management - Vendors and suppliers can efficiently track the items they hire out to clients </span><span class="text-primary fw-bold"> anywhere,</span> <span class="text-danger fw-bold">anytime,</span><br> from the reach of your phone or laptop connected to the internet..
						<br><span>3. Team collaboration - The team collaboration tool will let your team members conveniently work on projects collaboratively and even allows communication with the chat feature it comes with.</span><br>
						<br>Make it fast!&nbsp;<i class="fas fa-bolt" style="color:#FFD700;"></i><br> Make it easier!&nbsp;<i class="fas fa-thumbs-up" style="color: navy"></i><br>

					</p>
					<div class="d-lg-flex">
						<a href="demo.php" class="btn btn-danger text-white" style="border-radius: 20px"> Book Demo&nbsp;<i class="bi bi-arrow-right"></i></a>

					</div>
				</div>
				<div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
					<img src="hir/images/hero.png" class="img-fluid animated" alt="Merime Events image">
				</div>
			</div>
	</div>

	</section><!-- End Hero -->

	<main>
		<!-- ======= Accordion section======= -->
		<section>
			<div class="container">
				<div class="row">

					<div class="col-lg-6 col-md-12 col-sm-12">


						<div classs="row">
							<div class="section-title" data-aos="fade-up">

								<h3 class="text-info fw-bold">Registration Process</h3>

							</div>
							<div class="col-md-12 col-lg-12 col-sm-12 pt-2 border-primary" data-aos="zoom-in-up">
								<div class="accordion accordion-flush border border-left border-right" id="accordionFlushExample">
									<div class="accordion-item">
										<h5 class="accordion-header" id="flush-headingOne">
											<button class="accordion-button collapsed  text-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
												Registration
											</button>
										</h5>
										<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
											<div class="accordion-body " style="font-family: fangsong!important;">Navigate to the Register link on the Navigation bar and select the type of account you'd want to register (either free trial or paid membership) Note that the free trial lasts 30 days after which your account will be made inaccessible until further payments are made.</div>
										</div>
									</div>
									<div class="accordion-item">
										<h5 class="accordion-header" id="flush-headingTwo">
											<button class="accordion-button collapsed  text-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
												Signing up for a Paid Membership Account
											</button>
										</h5>
										<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
											<div class="accordion-body " style="font-family: fangsong!important;">On the navigation bar, Select the paid membership option and register an account.A verification email will be sent to your email address.The email will contain your login credentials.Use these login cedentials to log into your account and select the package most suitabe for your business organization.Once payment is complete, you will be able to acccess Merime Events-run modules. </div>
										</div>
									</div>
									<div class="accordion-item">
										<h5 class="accordion-header" id="flush-headingThree">
											<button class="accordion-button collapsed text-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
												Signing up for Free Trial Account
											</button>
										</h5>
										<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
											<div class="accordion-body " style="font-family: fangsong!important;">
												On the navigation bar, Select the Free trial option.Select the package you want to try out and all other necessary fields and submit.A verification email will be sent to your email address.Use the credentials provided in the email to create a password.Use the password to log in to your account and start enjoying Merime events-run benefits.

											</div>
										</div>
									</div>
								</div>
							</div>


						</div>
						<div class="row" data-aos="fade-up">
							<div class="call-btn text-center my-3">
								<a href="tel:+254757414345" class="btn btn-danger text-left text-white" style="border-radius: 20px" font-family:fangsong!important;><i class="bi bi-telephone h2rounded">&nbsp; Need Help? </i></a>
							</div>
							<h4 class="text-center call small" style="font-family:fangsong!important;" data-aos="zoom-in"><em>Call us Today!</em></h4>
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12">
						<div id="carouselExampleControls" class="carousel carousel-fade" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img class="d-block w-100" src="hir/img/chairs.jpg" alt="First slide">
									<div class="carousel-caption">
										<h5>Manage Inventory for Hire</h5>
										<p>Chairs</p>
									</div>
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="hir/images/chairs.jpg" alt="Second slide">
									<div class="carousel-caption">
										<h5>Manage Inventory for Hire</h5>
										<p>Decor</p>
									</div>
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="hir/images/tables.jpg" alt="Third slide">
									<div class="carousel-caption">
										<h5>Manage Inventory for Hire</h5>
										<p>Tables</p>
									</div>
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="hir/img/hema.jpg" alt="Fourth slide">
									<div class="carousel-caption">
										<h5>Manage Inventory for Hire</h5>
										<p>Tents</p>
									</div>
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="hir/images/cars.jpg" alt="Fifth slide">
									<div class="carousel-caption">
										<h5>Manage Inventory for Hire</h5>
										<p>Vehicles</p>
									</div>
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="hir/images/machine.jpg" alt="Sixth slide">
									<div class="carousel-caption">
										<h5>Manage Inventory for Hire</h5>
										<p>Machinery</p>
									</div>
								</div>
								<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>

						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- ======= About section======= -->
		<section style="background:url(hir/img/abstract.jpg);background-attachment:fixed;width:100%;">
			<div class="container">

				<div class="section-title">

					<h1 class="text-info fw-bold" data-aos="fade-down">MERIME EVENTS-RUN OFFERS MORE!</h1>

				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-lg-4">
						<p class=" " style="font-size:20px;" data-aos="fade-right">Inventory management,project management,Invoices and Payments management all in one system.<br>
							Keep track of all your hired or leased items.
						</p>
					</div>
					<div class="col-md-12 col-sm-12 col-lg-4 mb-1 mt-1">
						<img src="hir/img/manage.jpg" class="manage img-fluid" alt="Merime Events image">
					</div>
					<div class=" col-md-12 col-sm-12 col-lg-4 mt-3 pt-3">
						<p class=" " style="font-size:20px;" data-aos="fade-left"> Access maintained reports of all transactions in pdf and excel printable formats .<br>
							Why worry when Merime Events-run got you?
						</p>
					</div>

					<div class="text-center">
						<a class="h3" style="text-decoration: none;" href="demo.php">Click Here for demo!</a><br>
						<p class="text-primary h4 fw-bold"> <span class="text-danger">Link up </span>with us Now for a whole <span class="text-danger ">30-day</span> free trial!.</p>
						<div>
							<a class="btn btn-danger mt-1 mb-3" data-aos="fade-down" href="free-trial.php" style="border-radius: 20px">Sign Up for a free trial today</a>
						</div>
					</div>
				</div>

			</div>
		</section>

		<!-- ======= Modules Section======= -->
		<section>
			<div class="container" data-aos="fade-right">

				<div class="section-title">

					<h2 class="fw-bold text-info">Modules</h2>

				</div>

				<div class="row d-flex justify-between g-3">
					<div class="col-md product-boxx " data-aos="fade-up">
						<div class="service">
							<div class="card bg-light " style="border-radius: 20px">
								<div class="card-body text-center">
									<h4 class="card-title mb-3 fw-bold text-primary"><i class="bi bi-people text-danger"></i> &nbsp;Customer Registration</h4>
									<div class="card-text ">
										<p>Sign up all your customers with the system and Manage their accounts and transactions in a few steps</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md product-boxx " data-aos="fade-up" data-aos-delay="50">
						<div class="service">
							<div class="card bg-light " style="border-radius: 20px">
								<div class="card-body text-center">
									<h4 class="card-title mb-3 fw-bold text-primary"><i class="bi bi-book-fill text-danger"></i> &nbsp;Invoices</h4>
									<div class="card-text ">
										<p>Generate invoices for all items in transaction. Update partial or full payments by customers and track balances dates of payments.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md product-boxx " data-aos="fade-up" data-aos-delay="70">
						<div class="service">
							<div class="card bg-light " style="border-radius: 20px">
								<div class="card-body text-center">
									<h4 class="card-title mb-3 fw-bold text-primary"><i class="bi bi-clipboard-data text-danger"></i>

										&nbsp;Reports</h4>
									<div class="card-text ">
										<p>Access printable formats for all module reports in excel and pdf format</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-5 mb-5 g-3">
					<div class="col-md product-boxx " data-aos="fade-up" data-aos-delay="90">
						<div class="service">
							<div class="card bg-light " style="border-radius: 20px">
								<div class="card-body text-center">
									<h4 class="card-title mb-3 fw-bold text-primary"><i class="bi bi-people text-danger"></i> &nbsp;User Accounts</h4>
									<div class="card-text ">
										<p>Control user access to different packages by creating user accounts on package subscription basis.Create, assign and manage roles availed to users also.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md product-boxx " data-aos="fade-up" data-aos-delay="110">
						<div class="service">
							<div class="card bg-light " style="border-radius: 20px">
								<div class="card-body text-center">
									<h4 class="card-title mb-3 fw-bold text-primary"><i class="bi bi-clipboard text-danger"></i> &nbsp;Leasing Items</h4>
									<div class="card-text ">
										<p>Keep track of hired out items to specific customers, dates and quantity of the leased items</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md product-boxx " data-aos="fade-up" data-aos-delay="130">
						<div class="service">
							<div class="card bg-light " style="border-radius: 20px">
								<div class="card-body text-center">
									<h4 class="card-title mb-3 fw-bold text-primary"><i class="bi bi-clipboard text-danger"></i> &nbsp;Returned Items</h4>
									<div class="card-text ">
										<p>Manage records of all returned items and record their damage state and return due date and create their bills. </p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-5 mb-5 g-3">
					<div class="col-md product-boxx " data-aos="fade-up" data-aos-delay="150">
						<div class="service">
							<div class="card bg-light " style="border-radius: 20px">
								<div class="card-body text-center">
									<h4 class="card-title mb-3 fw-bold text-primary"><i class="bi bi-clipboard text-danger"></i> &nbsp;Inventories</h4>
									<div class="card-text ">
										<p>Manage all stocks by adding new stock, restock and checking stock levels. Set charges for damages items and those returned past due date.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md product-boxx " data-aos="fade-up" data-aos-delay="170">
						<div class="service">
							<div class="card bg-light " style="border-radius: 20px">
								<div class="card-body text-center">
									<h4 class="card-title mb-3 fw-bold text-primary"><i class="bi bi-clipboard text-danger"></i> &nbsp;Penalties</h4>
									<div class="card-text ">
										<p>The penalty module helps you monitor items in terms of late returned or damaged and track client partial or complete payment.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-5 mb-2">
					<div class="col-md product-boxx " data-aos="fade-up" data-aos-delay="170">
						<div class="service">
							<div class="card bg-light " style="border-radius: 20px">
								<div class="card-body text-center">
									<h4 class="card-title mb-3 fw-bold text-primary"><i class="bi bi-people text-danger"></i> &nbsp;Tasks/Team Collaboration</h4>
									<div class="card-text ">
										<p>Collaborate with your team from anywhere; perfect for small teams that work in office or virtually. Create projects with their deadlines, under projects, create tasks and assign them to the team member responsible with specific deadlines. Team members can update task progress by percentage. Even more exciting is a chat feature for each task for sharing ideas on the task at hand.

										</p>
										<h5>Try it today, make your team more efficient.</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md product-boxx " data-aos="fade-up" data-aos-delay="170">
						<div class="service">
							<div class="card bg-light " style="border-radius: 20px">
								<div class="card-body text-center">
									<h4 class="card-title mb-3 fw-bold text-primary"><i class="bi bi-calendar2-event text-danger"></i> &nbsp;Events </h4>
									<div class="card-text ">
										<p>This module is specifically designed for event planners. Whether you have items to hire or handle the planning only. It has within it features that allow for creating quotations from which you can generate an invoice and an inbuilt lease module in case you have the event equipment. It is also built in with a task management module to help make easy accomplish every task towards making a memorable and beautiful event.

										</p>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</section>
		<!-- ======= Packages======= -->
		<section>
			<div class="container" data-aos="fade-left">

				<div class="section-title">

					<h2 class="fw-bold text-info">Packages</h2>
					<p class=" bat" style="font-family:fangsong; color:red;"><em>Best deals for you!!</em></p>

				</div>
				<div classs="row">
					<div class="row justify-between g-4">
						<div class="col-md product-boxx ">
							<div class="service">
								<div class=" by card bg-light h-100">
									<div class="card-body text-center">
										<h4 class="card-title mb-3 fw-bold" style="color:#cd7f32;">BRONZE PACKAGE</h4>
										<h5 class="card-title mb-2 ">KSH 1000 / $15 per Month</h5>
										<div class="card-text ">
											<p class="fw-bold"> <i class="bi bi-check"></i>Project (Event) management</p>
											<p class="fw-bold"><i class="bi bi-check"></i> Customer registration </p>
											<p class="fw-bold"><i class="bi bi-check"></i> Invoices </p>
											<p class="fw-bold"> <i class="bi bi-check"></i>Reports </p>
											<p class="fw-bold"><i class="bi bi-check"></i> 1 user account </p>
											<a href="free-trial.php" class="btn btn-danger" style="border-radius: 20px">Try It for Free</a><br><br>
											<h4 style=" height:12px" class=" text-center text-danger" data-aos="zoom-in-up" data-aos-easing="ease-out-cubic" data-aos-duration="2000">30 DAYS FREE!!</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md product-boxx">
							<div class="service">
								<div class="by card bg-light">
									<div class="card-body text-center">
										<h4 class="card-title mb-3  fw-bold" style="color:#C0C0C0;">SILVER PACKAGE</h4>
										<h5 class="card-title mb-2 ">KSH 1500 /$ 20 per Month</h5>
										<div class="card-text ">
											<p class="fw-bold"> <i class="bi bi-check"></i>Everything in Bronze Plus </p>
											<p class="fw-bold"><i class="bi bi-check"></i> Leasing items</p>
											<p class="fw-bold"><i class="bi bi-check"></i> Returning items</p>
											<p class="fw-bold"> <i class="bi bi-check"></i>Inventory management</p>
											<p class="fw-bold"><i class="bi bi-check"></i> 3 user accounts </p>
											<a href="free-trial.php" class="btn btn-danger" style="border-radius: 20px">Try It for Free</a><br><br>
											<h4 style=" height:10px" class=" text-center text-danger" data-aos="zoom-in-up" data-aos-easing="ease-out-cubic" data-aos-duration="3000">30 DAYS FREE!!</h4>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md product-boxx">
							<div class="service">
								<div class=" by card bg-light">
									<div class="card-body text-center ">
										<h4 class="card-title mb-3  fw-bold" style="color:#FFD700;">GOLD PACKAGE</h4>
										<h5 class="card-title mb-2 ">KSH 2500 / $35 per Month</h5>
										<div class="card-text ">
											<p class="fw-bold"> <i class="bi bi-check"></i>Everything in Silver Plus </p>
											<p class="fw-bold"><i class="bi bi-check"></i> Penalities</p>
											<p class="fw-bold"><i class="bi bi-check mb-5"></i>Unlimited users </p>

											<a href="free-trial.php" class="btn btn-danger mt-5" style="border-radius: 20px">Try It for Free</a><br><br>
											<h4 style=" height:10px" class=" text-center text-danger" data-aos="zoom-in-up" data-aos-easing="ease-out-cubic" data-aos-duration="3000">30 DAYS FREE!!</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div classs="row ">
					<div class="row justify-between mt-3 g-4">
						<div class="col-md product-boxx ">
							<div class="service">
								<div class=" by card bg-light h-100">
									<div class="card-body text-center">
										<h4 class="card-title mb-3 fw-bold" style="color:#cd7f32;">TEAM COLLABORATION 1</h4>
										<h5 class="card-title mb-2 ">1,500 OR $20 / month</h5>
										<div class="card-text ">
											<p class="fw-bold"> <i class="bi bi-check"></i> Task Management</p>
											<p class="fw-bold"><i class="bi bi-check"></i> 10 User Accounts </p>
											<p class="fw-bold"><i class="bi bi-check"></i> Reports </p>
											<p class="fw-bold"> <i class="bi bi-check"></i>Inbuilt Team Chat </p>
											<p class="fw-bold"><i class="bi bi-check"></i> Settings</p>
											<a href="free-trial.php" class="btn btn-danger" style="border-radius: 20px">Try It for Free</a><br><br>
											<h4 style=" height:12px" class=" text-center text-danger" data-aos="zoom-in-up" data-aos-easing="ease-out-cubic" data-aos-duration="2000">30 DAYS FREE!!</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md product-boxx ">
							<div class="service">
								<div class=" by card bg-light h-100">
									<div class="card-body text-center">
										<h4 class="card-title mb-3 fw-bold" style="color:#000099;">TEAM COLLABORATION 2</h4>
										<h5 class="card-title mb-2 ">2,000 OR $25 / month</h5>
										<div class="card-text ">
											<p class="fw-bold"> <i class="bi bi-check"></i> Task Management</p>
											<p class="fw-bold"><i class="bi bi-check"></i> 15 User Accounts </p>
											<p class="fw-bold"><i class="bi bi-check"></i> Reports </p>
											<p class="fw-bold"> <i class="bi bi-check"></i>Inbuilt Team Chat </p>
											<p class="fw-bold"><i class="bi bi-check"></i> Settings</p>
											<a href="free-trial.php" class="btn btn-danger" style="border-radius: 20px">Try It for Free</a><br><br>
											<h4 style=" height:12px" class=" text-center text-danger" data-aos="zoom-in-up" data-aos-easing="ease-out-cubic" data-aos-duration="2000">30 DAYS FREE!!</h4>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md product-boxx ">
							<div class="service">
								<div class=" by card bg-light h-100">
									<div class="card-body text-center">
										<h4 class="card-title mb-3 fw-bold" style="color:#00cc99;">TEAM COLLABORATION 3</h4>
										<h5 class="card-title mb-2 ">3,000 OR $35 / month</h5>
										<div class="card-text ">
											<p class="fw-bold"> <i class="bi bi-check"></i> Task Management</p>
											<p class="fw-bold"><i class="bi bi-check"></i> 30 User Accounts </p>
											<p class="fw-bold"><i class="bi bi-check"></i> Reports </p>
											<p class="fw-bold"> <i class="bi bi-check"></i>Inbuilt Team Chat </p>
											<p class="fw-bold"><i class="bi bi-check"></i> Settings</p>
											<a href="free-trial.php" class="btn btn-danger" style="border-radius: 20px">Try It for Free</a><br><br>
											<h4 style=" height:12px" class=" text-center text-danger" data-aos="zoom-in-up" data-aos-easing="ease-out-cubic" data-aos-duration="2000">30 DAYS FREE!!</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>




		<!-- ======= Contact Section ======= -->
		<section id="contact" class="contact">
			<div class="container">

				<div class="section-title">

					<h2 class="fw-bold text-info">Contact Us</h2>
					<p>Here is how you can reach us</p>
				</div>

				<div class="row" data-aos="fade-up">
					<div class="col-lg-6 ">
						<div class="info-box mb-4 bg-white">
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

					<div class="col-lg-3 col-md-6 ">
						<div class="info-box  mb-4 bg-white">
							<i class="bx bx-envelope"></i>
							<h3>Email Us</h3>
							<p><a href="mailto:help@merimevents-run.com">help@merimevents-run.com</a></p>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="info-box  mb-4 bg-white">
							<i class="bx bx-phone-call"></i>
							<h3>Call Us</h3>

							<p><a href="tel: +254757414345">+254757414345</a>

							</p>
						</div>
					</div>

				</div>

				<div class="row" data-aos="fade-up">

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

							<div class="text-center mt-3"><button type="submit" name="send" class="btn btn-danger rounded">Send Message</button></div>
						</form>
					</div>

				</div>

			</div>
		</section><!-- End Contact Section -->


	</main>
	<footer class="bg-dark mt-5">
		<div class="container">
			<div class="row">
				<div class="small">
					<p class="text-center mt-3" style="color:white;"><em> &copy; Merime solutions <script type="text/javascript">
								var year = new Date();
								document.write(year.getFullYear());

							</script></em> &nbsp;| &nbsp; <a href="privacy-policy">Privacy Policy</a></p>
				</div>
			</div>
		</div>
	</footer>


	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


	<!--
        <div id="preloader">

        	<h5 class="mb-3 font-weight-bold"><em>just a moment</em></h5>

        </div>
-->


	<!-- Vendor JS Files -->
	<script src="hir/assets/vendor/aos/aos.js"></script>
	<script src="hir/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="hir/assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="hir/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<!--<script src="hir/assets/vendor/php-email-form/validate.js"></script>-->
	<script src="hir/assets/vendor/swiper/swiper-bundle.min.js"></script>

	<!-- Template Main JS File -->
	<script src="hir/assets/js/main.js"></script>
	<!--Bootstrap popper-->

	<!--script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script-->

</body>

</html>
