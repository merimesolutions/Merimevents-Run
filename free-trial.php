<?php
session_start();
$con = mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die("connection failed" . mysqli_error());
if (isset($_POST['btn_login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$squery = mysqli_query($con, "select * from tblstaff where username = '$username' and password = '$password' ");
	while ($row = mysqli_fetch_array($squery)) {
		$date = $row['reg_date'];
		$earlier = new DateTime($date);
		$later = new dateTime(date("Y-m-d"));
		$diff = $later->diff($earlier)->format("%a");
		if ($diff > 30) {
			$delete_query = mysqli_query($con, "UPDATE tblstaff SET status = 'inactive' where username = '$username' and password = '$password'  ") or die('Error: ' . mysqli_error($con));
		}
	}
}
?>
<?php
if (isset($_POST['btn_login'])) {
	$mysqli = new MySQli('localhost', 'merimeve_event', 'user@event', 'merimeve_event');
	$username = $mysqli->real_escape_string($_POST['username']);
	$password = $mysqli->real_escape_string($_POST['password']);

	$user = $mysqli->query("SELECT * from tblstaff where (username = '$username' or email = '$username') and password = '$password' and accounttype='admin' and status='active' ");
	if ($user->num_rows != 0) {
		$row = $user->fetch_assoc();
		$_SESSION['role'] = "admin";
		$_SESSION['userid'] = $row['id'];
		$_SESSION['company'] = $row['company'];
		$_SESSION['username'] = $row['full_name'];
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + 18000;
		header('location: hir/hip/usad/db');
	}
	else {

		echo '<script type="text/javascript">';
		echo 'alert("Your 30 days free trial is over. Please pay to enjoy our services.");';
		echo 'window.location = "price";';
		echo '</script>';
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link href="../themes/images/merimevents.png" rel="icon">
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
		/*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
		*/

		.border-md {
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
			background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("hir/images/registration-banner.png");
			width: 100% !important;
			max-height: 60vh !important;

			background-position: center;

			background-repeat: no-repeat;

			background-size: cover;

		}

		/* Extra small devices (phones, 600px and down) */
		@media only screen and (max-width: 600px) {

			.jumbtron {
				height: 80vh;
			}
		}

		/* Small devices (portrait tablets and large phones, 600px and up) */
		@media only screen and (min-width: 600px) {

			.jumbtron {
				height: 80vh;
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
				<a href="https://m.facebook.com/merimeventsrun" class="facebook"><i class="bi bi-facebook"></i></a>
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
							<li><a href="https://merimevents-run.com/free-trial" class="nav-link active">Free Trial</a></li>
							<li><a href="https://merimevents-run.com/hir/register">Paid Membership</a>
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
		<?php
function RandomString($length)
{
	$keys = array_merge(range(0, 9));
	//$keys = array_merge(range(1,9), range('a', 'z'), range('A', 'Z'));
	$key = "";
	for ($i = 0; $i < $length; $i++) {
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

		<div class="container mt-5 mb-5">
			<div class="row py-5 mt-4 align-items-center">
				<!-- For Demo Purpose -->
				<div class="col-md-5 pr-lg-5 mb-5 ">
					<h4 class="text-center" style="font-family: fangsong;"><strong>Login Form</strong></h4>
					<form action="#" method="post">
						<div class="row">


							<input type="hidden" name="next" value="/">
							<!-- Username-->
							<div class="input-group col-lg-12 mb-4">
								<div class="input-group-prepend">
									<span class="input-group-text bg-white px-4 border-md border-right-0">
										<i class="fas fa-file-signature text-muted "></i>
									</span>
								</div>
								<input type="text" name="username" id="username" placeholder="Enter username or Email address" class="form-control bg-white border-left-0 border-md">
							</div>
							<!--Password-->
							<!-- Username-->
							<div class="input-group col-lg-12 mb-4">
								<div class="input-group-prepend">
									<span class="input-group-text bg-white px-4 border-md border-right-0">
										<i class="fas fa-lock text-muted "></i>
									</span>
								</div>
								<!--div class="controls"-->
								<input type="password" name="password" placeholder="Enter your Password" id="password" class="form-control bg-white border-left-0 border-md">
								<!--/div-->
							</div>
							<div class="form-group col-lg-12 mx-auto mb-0">
								<button type="submit" name="btn_login" class="btn btn-success btn-block py-2">
									<span class="font-weight-bold">Sign into your account</span>
								</button>
							</div>
							<!-- Divider Text -->
							<div class="form-group col-lg-12 mx-auto d-flex align-items-center my-2">
								<div class="border-bottom w-100 ml-5"></div>
								<span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
								<div class="border-bottom w-100 mr-5"></div>

							</div>
							<div class="small form-group mx-auto d-flex align-items-center my-2">
								<a href="reset.php" style="text-align:center!important color:navy!important;">Forgot password?</a>
							</div>

							<!--p class="reset"><span class="">Your LOGIN credentials will expire after 30 days</span></p-->
							<img src="hir/images/reg.jpg" style="height: 30vh; width: 100%;">


						</div>
					</form>
				</div>

				<!-- Registeration Form -->
				<div class="col-md-7 col-lg-6 ml-auto">
					<h4 class="title mb-3 text-center" style="font-family:fangsong;"><strong>30 days Free Registration</strong></h4>
					<form action="in.php" method="post" class="form-stacked">

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
										<i class="fa fa-user text-muted"></i>
									</span>
								</div>
								<input type="text" name="company" placeholder="Company Name" class="form-control bg-white border-left-0 border-md">
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
										<i class="fas fa-file-signature text-muted "></i>
									</span>
								</div>
								<input type="text" name="username" placeholder="User Name" class="form-control bg-white border-left-0 border-md">
							</div>


							<input type="hidden" name="pass" value="<?php echo RandomString(6); ?>" />
							<!-- Phone Number -->
							<div class="input-group col-lg-12 mb-4">
								<div class="input-group-prepend">
									<span class="input-group-text bg-white px-4 border-md border-right-0">
										<i class="fa fa-phone-square text-muted"></i>
									</span>
								</div>

								<input type="text" name="contact" pattern="[0-9]+" maxlength="12" minlength="6" placeholder="2547 xxx xxxxx" class="form-control bg-white border-left-0 border-md">

							</div>
								<!-- Phone Number -->
							<div class="input-group col-lg-12 mb-4">
								<div class="input-group-prepend">
									<span class="input-group-text bg-white px-4 border-md border-right-0">
										<i class="fa fa-map text-muted"></i>
									</span>
								</div>

								<input type="text" name="location" placeholder="Enter Location" class="form-control bg-white border-left-0 border-md">

							</div>


							<!-- Package -->
							<div class="input-group col-lg-12 mb-4">
								<div class="input-group-prepend">
									<span class="input-group-text bg-white px-4 border-md border-right-0">
										<i class="fas fa-box-open text-muted"></i>
									</span>
								</div>
								<select id="job" name="package" class="form-control custom-select bg-white border-left-0 border-md">
									<option value="" Disabled selected>Select package</option>
									<option value="1">Bronze package</option>
									<option value="2">Silver package</option>
									<option value="3">Gold package</option>
									<option value="4">Team Collaborations</option>

								</select>
							</div>

							<br>
								<div class="g-recaptcha mt-1 mb-1 d-flex justify-content-center"
									data-sitekey="6LcWLecfAAAAAGZe_KUWpkAiEiRjJ_BwFxO9iLki">
								</div>
							<br>

							<!-- Submit Button -->
							<div class="form-group col-lg-12 mx-auto mb-0 mt-1">
								<button type="submit" name="register" class="btn btn-primary btn-block py-2">
									<span class="font-weight-bold">Create your account</span>
								</button>
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
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>

</html>
