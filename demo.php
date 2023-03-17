
<!DOCTYPE html>
<html lang="en">

<!-- <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
    <link href="../themes/images/merimevents.png" rel="icon">
	<title>Merime Events-run</title>

	Template based on URL below
	<!DOCTYPE html>
	<html lang="en"> -->

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../../../favicon.ico">
		<title>Merime Events-run</title>

		<!--Template based on URL below-->

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- Bootstrap core CSS -->

		<!--More Links-->
		<!-- Google Fonts -->
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!--AOS-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

		<!-- Vendor CSS Files -->
		<link href="hir/assets/vendor/aos/aos.css" rel="stylesheet">
		<link href="hir/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="hir/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="hir/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
		<link href="hir/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
		<link href="hir/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
		<!-- Place your stylesheet here-->
		<!-- Template Main CSS File -->
		<link href="hir/assets/css/style.css" rel="stylesheet">



		<style>
			* *==========================================* CUSTOM UTIL CLASSES *==========================================* */ .border-md {
				border-width: 2px;
			}

			.btn-facebook {
				background: #405D9D;
				border: none;
			}

			.btn-facebook:hover,
			.btn-facebook:focus {
				background: #314879;
			}

			.btn-twitter {
				background: #42AEEC;
				border: none;
			}

			.btn-twitter:hover,
			.btn-twitter:focus {
				background: #1799e4;
			}



			/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/

			/*main .container {
			background-color: #ccc;
			background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.2) 25%, rgba(0, 0, 0, 0) 25%, rgba(0, 0, 0, 0) 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, rgba(0, 0, 0, 0) 75%, rgba(0, 0, 0, 0));
			background-size: 50px 50px;

		}
		*/

			.form-control:not(select) {
				padding: 1.5rem 0.5rem;
			}

			select.form-control {
				height: 52px;
				padding-left: 0.5rem;
			}

			.form-control::placeholder {
				color: #ccc;
				font-weight: bold;
				font-size: 0.9rem;
			}

			.form-control:focus {
				box-shadow: none;
			}

			.img {
				background: left bottom no-repeat,
			}


			.jumbotron {
				color: white;
				background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("hir/images/demol.jpg");
				width: 100% !important;
				max-height: 60vh !important;

				background-position: center;

				background-repeat: no-repeat;

				background-size: cover;


			}

			/* Extra small devices (phones, 600px and down) */
			@media only screen and (max-width: 600px) {

				.jumbtron {
					height: 60vh;
				}
			}

			/* Small devices (portrait tablets and large phones, 600px and up) */
			@media only screen and (min-width: 600px) {

				.jumbtron {
					height: 60vh;
				}
			}

			/* Medium devices (landscape tablets, 768px and up) */
			@media only screen and (min-width: 768px) {
				.jumbotron {
					height: 60vh;

				}

				/* Large devices (laptops/desktops, 992px and up) */
				@media only screen and (min-width: 992px) {
					.jumbtron {
						height: 60vh;
					}
				}
				/* Extra large devices (large laptops and desktops, 1200px and up) */
				@media only screen and (min-width: 1200px) {
					.jumbtron {
						height: 60vh;
					}
				}
				/*Vertical Marquee*/
				.container3 {

					overflow: hidden;
					background: #ffffff;
					position: relative;
				}

				.slider {
					top: 1em;
					position: relative;
					box-sizing: border-box;
					animation: slider 15s linear infinite;
					list-style-type: none;
					text-align: center;
				}

				.slider:hover {
					animation-play-state: paused;
				}

				@keyframes slider {
					0% {
						top: 10em
					}

					100% {
						top: -16em
					}
				}

				.blur .slider {
					margin: 0;
					padding: 0 1em;
					line-height: 1.5em;
				}

				.blur:before,
				.blur::before,
				.blur:after,
				.blur::after {
					left: 0;
					z-index: 1;
					content: '';
					position: absolute;
					width: 100%;
					height: 2em;
					background-image: linear-gradient(180deg, #FFF, rgba(255, 255, 255, 0));
				}

				.blur:after,
				.blur::after {
					bottom: 0;
					transform: rotate(180deg);
				}

				.blur:before,
				.blur::before {
					top: 0;
				}

				p {
					font-family: helvetica, arial, sans serif;
				}
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
						<li><a class="nav-link active" href="demo">Demo</a></li>
						<li><a class="nav-link" href="portfolio">Portfolio</a></li>
						<li><a class="nav-link" href="price">Pricing Plans</a></li>
						<li><a class="nav-link" href="contact"> Contact </a></li>
					</ul>
					<i class="bi bi-list mobile-nav-toggle"></i>
				</nav><!-- .navbar -->

			</div>
		</header><!-- End Header -->

		<?php
					function RandomString($length) {
						$keys = array_merge(range(0,9));
						//$keys = array_merge(range(1,9), range('a', 'z'), range('A', 'Z'));
							$key = "";
							for($i=0; $i < $length; $i++) {
							$key .= $keys[mt_rand(0, count($keys) - 1)];
						}
							return $key;               
					}
		?>
		<main role="main mt-5">
			<div class="jumbotron">
				<!--div class="section-title">
					<h2 class="text-center mt-5" data-aos="fade-down" data-aos-anchor-placement="center-bottom" data-aos-duration="3000" style="font-family: fangsong; color: white;"><strong>Register</strong></h2>
				</div-->

			</div>

			<div class="container">
				<div class="row py-5 align-items-center">
					<div class="col-lg-2 mr-auto d-none d-lg-block">
						<div class="container3 blur">
							<ul class="slider">
								<li>
									<p class="small" style="font-family: fangsong!important;"><em><strong>We help you manage all kinds of inventory:</strong></em></p>
								</li>
								<li>
									<img src="hir/images/cars.jpg" style="width: 100%;">
									<p style="font-family: fangsong!important;">Cars</p>

								</li>
								<li>
									<img src="hir/images/tents.png" style="width: 100%;">
									<p style="font-family: fangsong!important;">Tents</p>
								</li>
								<li>
									<img src="hir/images/chairs.jpg" style="width: 100%;">
									<p style="font-family: fangsong!important;">Chairs</p>
								</li>
								<li>
									<img src="hir/images/tables.jpg" style="width: 100%;">
									<p style="font-family: fangsong!important;"> Tables</p>

								</li>
								<li>
									<img src="hir/images/machine.jpg" style="width: 100%;">
									<p style="font-family: fangsong!important;"> Machinery</p>
								</li>

							</ul>
						</div>
					</div>
					<!-- For Demo Purpose -->
					<!--div class="col-md-5 pr-lg-5 mb-5 ">
						<h4 class="text-center" style="font-family: fangsong;"><strong>Login Form</strong></h4>
						<form action="#" method="post">
							<div class="row">


								
								<div class="input-group col-lg-12 mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text bg-white px-4 border-md border-right-0">
											<i class="fas fa-file-signature text-muted "></i>
										</span>
									</div>
									<input type="text" name="username" id="username" placeholder="Enter username or Email address" class="form-control bg-white border-left-0 border-md">
								</div>
								
								<div class="input-group col-lg-12 mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text bg-white px-4 border-md border-right-0">
											<i class="fas fa-lock text-muted "></i>
										</span>
									</div>
								
									<input type="password" name="password" placeholder="Enter your Password" id="password" class="form-control bg-white border-left-0 border-md">
									
								</div>
								<div class="form-group col-lg-12 mx-auto mb-0">
									<button type="submit" name="btn_login" class="btn btn-success btn-block py-2">
										<span class="font-weight-bold">Sign into your account</span>
									</button>
								</div>
								
								<div class="form-group col-lg-12 mx-auto d-flex align-items-center my-2">
									<div class="border-bottom w-100 ml-5"></div>
									<span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
									<div class="border-bottom w-100 mr-5"></div>

								</div>
								<div class="small form-group mx-auto d-flex align-items-center my-2">
									<a href="reset.php" style="text-align:center!important">Forgot password?</a>
								</div>

								class="reset"><span class="">Your LOGIN credentials will expire after 30 days</span></p
								<img src="NYUMBA/img/reg.jpg" style="height: 30vh; width: 100%;">


							</div>
						</form>
					</div>

					Registeration Form -->
					<div class="col-md-7 col-lg-7 mx-auto">
						<h4 class="mb-3 text-center" style="font-family:fangsong; color: black;"><strong>Request a Demo</strong></h4>
						<form action="din.php" method="post" class="form-stacked">
							<div class="row">
								<!-- First Name -->
								<div class="input-group col-lg-6 mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text bg-white px-4 border-md border-right-0">
											<i class="fa fa-user text-muted"></i>
										</span>
									</div>
									<input type="text" name="full_name" placeholder="Full Name" class="form-control bg-white border-left-0 border-md">
								</div>
								<!-- Last Name -->
								<div class="input-group col-lg-6 mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text bg-white px-4 border-md border-right-0">
											<i class="fa fa-phone text-muted"></i>
										</span>
									</div>
									<input type="text" name="contact" pattern="[0-9]+" maxlength="12" minlength="6" placeholder="2547 xxx xxxxx" class="form-control bg-white border-left-0 border-md">
								</div>
								<!-- Email Address -->
								<div class="input-group col-lg-12 mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text bg-white px-4 border-md border-right-0">
											<i class="fa fa-envelope text-muted"></i>
										</span>
									</div>
									<input type="email" name="email" placeholder="Email Address" class="form-control bg-white border-left-0 border-md">
								</div>
								<!-- Username-->
								<div class="input-group col-lg-12 mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text bg-white px-4 border-md border-right-0">
											<i class="fas fa-home text-muted "></i>
										</span>
									</div>
									<input type="text" name="company" placeholder="Company Name" class="form-control bg-white border-left-0 border-md">
								</div>
								<input type="hidden" name="pass" value="<?php echo RandomString(6); ?>" />
								<!-- Phone Number -->
								<div class="input-group col-lg-12 mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text bg-white px-4 border-md border-right-0">
											<i class="fa fa-map text-muted"></i>
										</span>
									</div>
									<input type="text" name="location" placeholder="Location" class="form-control bg-white border-left-0 border-md">
								</div>

								<!-- date -->
								<label class="col-lg-12 mb-4 text-muted small">Enter desired date for the demo</label>
								<div class="input-group col-lg-12 mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text bg-white px-4 border-md border-right-0">
											<i class="fas fa-calendar text-muted"></i>
										</span>
									</div>
									<input type="date" name="date" placeholder="Enter desired date the demo" class="form-control" required>
								</div>
								<!--Comments-->
								<div class="input-group col-lg-12 mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text bg-white px-4 border-md border-right-0">
											<i class="fas fa-quote-right text-muted"></i>
										</span>

									</div>
									<textarea class="form-control" placeholder="leave a comment" name="comment" id="exampleFormControlTextarea1" rows="5" required></textarea>
								</div>
								<!--Password-->
								<input type="hidden" name="pass" value="<?php echo RandomString(6); ?>" />
								<!-- Submit Button -->
								<div class="form-group col-lg-12 mx-auto mb-0">
									<input type="submit" name="submit" class="btn btn-primary btn-block font-weight-bold py-2" value="submit">
										<!-- <span class="font-weight-bold">Submit</span>
									</button> -->
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</main>
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
		<!--AOS Script-->
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		<script>
			AOS.init();

		</script>
		<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
		<div id="preloader"></div>

		<!-- Vendor JS Files -->
		<script src="hir/assets/vendor/aos/aos.js"></script>
		<script src="hir/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="hir/assets/vendor/glightbox/js/glightbox.min.js"></script>
		<script src="hir/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
		<script src="hir/assets/vendor/php-email-form/validate.js"></script>
		<script src="hir/assets/vendor/swiper/swiper-bundle.min.js"></script>

		<!-- Template Main JS File -->
		<script src="hir/assets/js/main.js"></script>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>
