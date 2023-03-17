<?php
session_start();
        if(isset($_POST['btn_login']))
        { 
            $mysqli= NEW MySQli('localhost','merimeve_event','user@event','merimeve_event');
            $username =$mysqli->real_escape_string($_POST['txt_username']);
            $national_id =$mysqli->real_escape_string($_POST['txt_password']);
            $password =$mysqli->real_escape_string($_POST['txt_password']);
            $password1 =$mysqli->real_escape_string($_POST['txt_password']);

            $password1=md5($password1);

            $new = $mysqli->query ("SELECT * from tblstaff where username = '$username' and password = '$password' and status ='inactive' and package='0' ");
            if($new-> num_rows !=0){
              $row = $new->fetch_assoc();
              $_SESSION['role'] = "new";
              $_SESSION['userid'] = $row['id'];
              $_SESSION['company'] = $row['company'];
              $_SESSION['username'] = $row['full_name'];
              $_SESSION['start'] = time();
              $_SESSION['expire'] = $_SESSION['start'] + 18000;
               header ('location: hip/n/p.php');
            } 
            
            $active = $mysqli->query ("SELECT * from tblstaff where username = '$username' or email = '$username' and password = '$password' and package != '0' and status='active' ");
            if($active -> num_rows !=0){
              $row = $active->fetch_assoc();
              $_SESSION['role'] = "admin";
              $_SESSION['userid'] = $row['id'];
              $_SESSION['company'] = $row['company'];
              $_SESSION['username'] = $row['full_name'];
              $_SESSION['start'] = time();
              $_SESSION['expire'] = $_SESSION['start'] + 18000;
               header ('location: hip/usad/db.php');
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
               header ('location: hip/user/dashboard.php');
            }
            $merime = $mysqli->query ("SELECT * from tblmerime where username = '$username' and password = '$password' and merime = 'merime' ");
            if($merime -> num_rows !=0){
              $row = $merime->fetch_assoc();
              $_SESSION['merime'] = "merime";
              $_SESSION['userid'] = $row['id'];
              $_SESSION['username'] = $row['full_name'];
              $_SESSION['start'] = time();
              $_SESSION['expire'] = $_SESSION['start'] + 18000;
               header ('location: hip/admin/dashboard.php');
            }
             else
                {
        echo '<script type="text/javascript">'; 
        echo 'alert("Wrong Username or Password !!!");'; 
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
		<title>Merime Events-run</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link rel="shortcut icon" href="images/fire.png" type="image/x-icon">
        <!-- bootstrap 3.0.2 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">		
		<link href="../themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="../themes/css/flexslider.css" rel="stylesheet"/>
		<link href="../themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="../themes/js/jquery-1.7.2.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>				
		<script src="../themes/js/superfish.js"></script>	
		<script src="../themes/js/jquery.scrolltotop.js"></script>
	</head>
    <body>		
		<div id="top-bar" class="container">
			<div class="row">
                <div class="col-md-6 col-md-offset-6 ">
					<h6><img src="../themes/images/merimevents.png" alt="image"  style="max-width: 32px" /> Merime Events-run</h6>
				</div>
				<div class="col-md-6 col-md-offset-6" >
					<div class="account pull-right">
						<ul class="user-menu" style="float:right">
						    <li><a href="https://merimevents-run.com/">Home</a></li>
							<li><a href="register.php">Register</a></li>
							
							<li><a class="" href="../demo.php">Book Demo</a></li>
							
							<li><a class="" href="../free-trial.php">Free Trial</a></li>	
						</ul>
					</div>
				</div>
			</div>
		</div>
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
		<div id="wrapper" class="container">
			</section>			
			<section class="header_text sub">
			<img class="pageBanner" src="../themes/images/login.jpg" alt="New products" style="width:100%">
				<h5><span>Customer login</span></h5>
				<span style="color:forestgreen;font-weight:bold;font-size:14px;">
				<?php
              date_default_timezone_set("Africa/Nairobi");

              // 24-hour format of an hour without leading zeros (0 through 23)
              $Hour = date('G');

              if ( $Hour >= 0 && $Hour <= 11 ) {
                  echo "Good Morning...";
              } else if ( $Hour >= 12 && $Hour <= 15 ) {
                  echo "Good Afternoon...";
              } else if ( $Hour >= 16 && $Hour <=18 ) {
                  echo "Good Evening...";
              } else if ( $Hour >= 19 && $Hour <=24 ) {
                  echo "Good Night...";
              }
              ?></span>
			</section>
			<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
			<div class="col-md-6 col-md-offset-6" style="margin:0 auto;">
			<section class="main-content">				
				<div class="row">
					<div class="span5">					
						
						<form role="form" method="post">
                  <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping">Username</span>
                      <input type="text" name="txt_username" class="form-control" placeholder="Enter username or Email address" aria-label="Username" aria-describedby="addon-wrapping" autocomplete="off">
                  </div>
                  <br>
                  <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping">Password.</span>
                      <input type="password" name="txt_password" class="form-control" placeholder="*********" aria-label="Password" aria-describedby="addon-wrapping" autocomplete="off">
                  </div>
                  <br>
                <button type="submit" class="btn btn-sm btn-success" name="btn_login" title="Click to login" style="width:45%">Login</button>
                <a href="register.php" class="btn btn-sm btn-info" style="float: right;width:45%"> Sign Up</a>
              </form><br>
              <a href="reset.php" style="text-decoration:none !important;">Forgot password?</a>
              <br><br>
              <a href="https://merimevents-run.com/free-trial.php" class="btn btn-sm btn-primary" name="btn_login" title="Click to login">Login for Free account</a><br><br>
              <p>
                  <a href="https://merimevents-run.com/" style="text-decoration:none !important; color:#000">Our Website</a>
              </p>
			
					</div>
				
				</div>
			</section>	
			</div>
			<section id="copyright">
				<center><h5>Contact us</h5>
                <p>2nd Floor Kilifi Plaza,</p>
                <p>P.O. Box 726 - 80108,</p>
                <p>Kilifi Town, Kilifi County, Kenya.</p>
                <p>Phone: +254 757 414 345</p>
                <a style="text-decoration:none; color:#fff;" href="mailto:help@merimevents-run.com?subject=" target="_blank">Email: help@merimevents-run.com</a>
				
				</center>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
		<script src="themes/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 5000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
				});
			});
		</script>
    </body>
</html>

