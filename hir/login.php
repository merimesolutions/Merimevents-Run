<?php
session_start();
        if(isset($_POST['btn_login']))
        { 
            $mysqli= NEW MySQli('localhost','merimeve_event','user@event','merimeve_event');
            $username =$mysqli->real_escape_string($_POST['txt_username']);
            $national_id =$mysqli->real_escape_string($_POST['txt_password']);
            $password =$mysqli->real_escape_string($_POST['txt_password']);
            $password1 =$mysqli->real_escape_string($_POST['txt_password']);

            //Mail And Password Validation
      
// 			$sql2=mysqli_query($mysqli,"SELECT * FROM tblstaff where (username='$username' OR email ='$username')");
// 			if($sql2){
//                  $num_rows = mysqli_num_rows($sql2);
// 					if($num_rows == 0 ){
//                       $user_err ="Incorrect Username Or Email Address";
//                       }elseif($num_rows ==1){
// 						while($row =mysqli_fetch_assoc($sql2)){
// 							$pass=$row['password'];
// 							$sql4=mysqli_query($mysqli,"SELECT * FROM tblstaff where (username='$username' OR email='$username') AND password='$password'");
// 							if($sql4){
// 								$number= mysqli_num_rows($sql4);
//                                 if($number == 0){
//                                     $password_err="Incorrect Password";
//                                         }
	
// 							}
// 						}

// 					}
// 			}
		//

            $new = $mysqli->query ("SELECT * from tblstaff where username = '$username' and password = '$password' and package='0' ");
            if($new-> num_rows !=0){
              $row = $new->fetch_assoc();
              $_SESSION['role'] = "new";
              $_SESSION['userid'] = $row['id'];
              $_SESSION['company'] = $row['company'];
              $_SESSION['username'] = $row['full_name'];
              $_SESSION['start'] = time();
              $_SESSION['expire'] = $_SESSION['start'] + 18000;
               header ('location: hip/n/p');
            } 
            $active = $mysqli->query ("SELECT * from tblstaff where (username = '$username' or email = '$username') and password = '$password' and package != '0' and status='active' ");
            if($active -> num_rows !=0){
              $row = $active->fetch_assoc();
              $_SESSION['role'] = "admin";
              $_SESSION['userid'] = $row['id'];
              $_SESSION['company'] = $row['company'];
              $_SESSION['username'] = $row['full_name'];
              $_SESSION['start'] = time();
              $_SESSION['expire'] = $_SESSION['start'] + 18000;
               header ('location: hip/usad/db');
            }
            //Free Trial Users
             $active1 = $mysqli->query ("SELECT * from tblstaff where (username = '$username' or email = '$username') and password = '$password' and package != '0' and temp_status='active' ");
            if($active1 -> num_rows !=0){
              $row = $active1->fetch_assoc();
              $_SESSION['role'] = "admin";
              $_SESSION['userid'] = $row['id'];
              $_SESSION['company'] = $row['company'];
              $_SESSION['username'] = $row['full_name'];
              $_SESSION['start'] = time();
              $_SESSION['expire'] = $_SESSION['start'] + 18000;
               header ('location: hip/usad/db');
            }
            $user = $mysqli->query ("SELECT * from tblusers where username = '$username' and password = '$password' ");
            if($user -> num_rows !=0){
              $row = $user->fetch_assoc();
              $_SESSION['role'] = $row['role'];
              $_SESSION['userid'] = $row['id'];
              $_SESSION['company'] = $row['company'];
              $_SESSION['username'] = $row['full_name'];
              $_SESSION['start'] = time();
              $_SESSION['expire'] = $_SESSION['start'] + 18000;
               header ('location: hip/user/db');
            }
            $merime = $mysqli->query ("SELECT * from tblmerime where username = '$username' and password = '$password' and merime = 'merime' ");
            if($merime -> num_rows !=0){
              $row = $merime->fetch_assoc();
              $_SESSION['merime'] = "merime";
              $_SESSION['userid'] = $row['id'];
              $_SESSION['username'] = $row['full_name'];
              $_SESSION['start'] = time();
              $_SESSION['expire'] = $_SESSION['start'] + 18000;
               header ('location: hip/admin/dashboard');
            }
             else
                {
        echo '<script type="text/javascript">'; 
        echo 'alert("Incorrect Username and Password");'; 
        echo 'window.location.href = window.location.href;';
        echo '</script>';
        exit;
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
	<link href="assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
	<!-- Place your stylesheet here-->
	<!-- Template Main CSS File -->
	<link href="assets/css/style.css" rel="stylesheet">


	<style>
	body {
			background: url(images/white.jpg);/*?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940*/
			width:100%;
			margin: 0;
			background-size: cover;
			background-repeat: no-repeat;
		}

		.logpad {
			min-width: 400px;
			max-width: 500px;
			background: linear-gradient(180deg, #181818, #181818, rgba(81, 81, 81, .7))!important;
			margin: auto;
			padding: 50px;
			text-align: center;
			/*border-radius: 40px;*/
		}

		.logpad span:first-child {
			font-family: Valeyola;
			color: #FF0000;
			font-size: 44px;
		}

		.logpad span:last-child {
			font-family: Gabriola;
			color: #fefefe;
			font-size: 44px;
		}

		.logpad input {
			border: none;
			outline: none;
			background: none;
			border-bottom: 2px solid navy;
			width: 100%;
			padding: 10px 0;
			color: #fefefe;
			font-family: "Century Gothic";
			font-size: 18px;
			margin-bottom: 20px;
			transition: .5s;
		}

		.logpad a {
			color: #fefefe !important;
			position: center;
		}

		.logbox {
			color: #fefefe;
			font-family: "Century Gothic";
			text-align: left;
		
		}

		.logo img {
			margin-top: -110px;
			border-radius: 50%;
			overflow: hidden;
			border: 10px solid rgb(24, 24, 24);
		}

		.logpad button {
			color: #fefefe;
			background-color: #CB4C4E;
			font-size: 21px;
			font-family: Lithos Pro;
			cursor: pointer;
			border: none;
			outline: none;
			padding: 10px;
			width: 100%;
			margin: 20px 0;
			transition: .3s;
			border-radius: 3px 20px;
		}

		.logpad button:hover {
			background-color: navy;
			color: white;

		}

		.logpad input:focus {
			background: white;
			border-bottom: 2px solid #fff;
		}

		@media(max-width: 720px) {
			.logpad {
				max-width: 240px;
			}

			body {
				background-size: 300% 200%;
				background-position: center;
			}
		}

	</style>

	</style>




</head>

<body>
	<!-- ======= Top Bar ======= -->
	<!-- ======= Top Bar ======= -->
	<section id="topbar" class="d-flex align-items-center">
		<div class="container d-flex justify-content-center justify-content-md-between">
			<div class="contact-info d-flex align-items-center">
				<i class="bi bi-envelope-fill"></i><a href="mailto:help@merimevents-run.com">help@merimevents-run.com</a>
				<i class="bi bi-phone-fill phone-icon"></i><a href="tel: +254757414345">+254757414345</a>
			</div>
			<div class="social-links d-none d-md-block">
				<a href="https://merimesolutions.com" class="twitter"><i class="fas fa-globe"></i></a>
				<a href="https://m.facebook.com/login.php?next=https%3A%2F%2Fm.facebook.com%2Fmerimeventsrun%2F&refsrc=deprecated&_rdr" class="facebook"><i class="bi bi-facebook"></i></a>
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
							<li><a href="../free-trial.php">Free Trial</a></li>
							<li><a href="register.php">Paid Membership</a>
							</li>
						</ul>

					<li><a class="nav-link active" href="login.php">Login</a></li>
					<li><a class="nav-link" href="../demo.php">Demo</a></li>
					<li><a class="nav-link" href="../portfolio">Portfolio</a></li>
					<li><a class="nav-link" href="../price.php">Pricing Plans</a></li>
					<li><a class="nav-link" href="../contact.php"> Contact </a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->

		</div>
	</header><!-- End Header -->
<main>

		<div class="text-center mb-5 pt-5">
			<!--h2 class="text-center" style="font-family:fangsong; color: white;" data-aos="fade-down" data-aos-placement="center-bottom" data-aos-duration="3000">Log In</h2-->
			<div class="logpad mt-3">
				<div class="logo">
					<img src="https://images.pexels.com/photos/1214205/pexels-photo-1214205.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" height="100" width="100">
				</div>
				<form role="form" method="post">
					<div data-aos="fade-down" data-aos-placement="center-bottom" data-aos-duration="3000">

						<span>Login</span>

					</div>
					<div class="logbox">
						<label>Username</label>
						<input type="text" name="txt_username" class="form-control" placeholder="Enter username or Email address" aria-label="Username" aria-describedby="addon-wrapping" autocomplete="off"Required>

						<label>Password</label>
						<input type="password" name="txt_password" class="form-control" placeholder="*********" aria-label="Password" aria-describedby="addon-wrapping" autocomplete="off"Required>
					</div>
					<button type="submit" name="btn_login">Login</button>
					<!-- Divider Text -->
					<div class="form-group col-lg-12 mx-auto d-flex align-items-center my-2">
						<div class="border-bottom w-100 ml-5"></div>
						<span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
						<div class="border-bottom w-100 mr-5"></div>

					</div>
					<div class="text-center">
						<div class="small align-items-center form-group mx-auto d-flex align-items-center my-2">
							<a href="register.php">dont have an account?signup</a>
						</div>
						<div class="small align-items-center form-group mx-auto d-flex align-items-center my-2">
							<a href="reset.php">Forgot password?</a>
						</div>
					</div>

				</form>
			</div>
		</div>

	</main>


	<footer class="bg-dark mt-5">
		<div class="container">
			<div class="row">
				<div class="small">
					<p class="text-center mt-3" style="color:white;"><em> &copy; Merime solutions <script type="text/javascript">var year = new Date();document.write(year.getFullYear());</script></em>
						&nbsp;| &nbsp; <a href="../privacy-policy">Privacy Policy</a>
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
	<script src="assets/vendor/aos/aos.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="assets/vendor/php-email-form/validate.js"></script>
	<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

	<!-- Template Main JS File -->
	<script src="assets/js/main.js"></script>

	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
