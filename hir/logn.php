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

            $new = $mysqli->query ("SELECT * from tblstaff where username = '$username' and password = '$password' and status !='active'");
            if($new-> num_rows !=0){
              $row = $new->fetch_assoc();
              $_SESSION['role'] = "new";
              $_SESSION['userid'] = $row['id'];
              $_SESSION['company'] = $row['company'];
              $_SESSION['username'] = $row['full_name'];
              $_SESSION['start'] = time();
              $_SESSION['expire'] = $_SESSION['start'] + 18000;
               header ('location: hip/n/d.php');
            } 
            
            $active = $mysqli->query ("SELECT * from tblstaff where username = '$username' and password = '$password' and package != '0' and status='active' ");
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
            
            $merime = $mysqli->query ("SELECT * from tblstaff where username = '$username' and password = '$password' and package != '0' and accountype='merime' ");
            if($merime -> num_rows !=0){
              $row = $merime->fetch_assoc();
              $_SESSION['role'] = "merime";
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
              $_SESSION['roleuser'] = $row['accounttype'];
              $_SESSION['role'] = $row['role'];
              $_SESSION['userid'] = $row['id'];
              $_SESSION['company'] = $row['company'];
              $_SESSION['username'] = $row['full_name'];
              $_SESSION['start'] = time();
              $_SESSION['expire'] = $_SESSION['start'] + 18000;
               header ('location: hip/user/dashboard.php');
            }
             else
                {
                  echo "<p><b><center  style='color:red;'>". 'Wrong Username or Password !!!'."</center></b></p>";
                }
             
        }
       
      ?>
<!DOCTYPE html>
<html style="background-color:#ECF0F1; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;overflow-y: hidden;overflow-x: hidden;">
<style type="text/css">
    body{ font: 14px sans-serif; }
    p a{color:#000;}
  </style>
    <head>
        <meta charset="UTF-8">
        <title>Merime | Event-run</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="images/merimevents.png" type="image/x-icon">
        <!-- bootstrap 3.0.2 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

        <!-- Theme style -->


    </head>
    <body class="skin-black" style="background-color: transparent; font-family: arial;">
        <center>
          <div style="margin-top:6%;" class="container">

          <div class="col-md-4 col-md-offset-4 ">
              <center style="font-family: cursive; font-size: 20px;">  
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
              ?></center>
            <br>
              <div class="panel">
            <div class="panel-heading">
              <h1 class="panel-title" >
              <center style="font-family:Sans-serif;font-size: 24px;letter-spacing: 5px;">Log<span style="font-weight: bolder;">in</span>
              </center>
            </h1>
            </div>
            <div class="panel-body">
              <form role="form" method="post">
                  <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping">Username</span>
                      <input type="text" name="txt_username" class="form-control" placeholder="Enter username" aria-label="Username" aria-describedby="addon-wrapping" autocomplete="off">
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
              <a href="reset.php">Forgot password?</a>
            </div>
          </div>
          
          </div>
          
        </div>
        </center>
</div> 
    </div>
      <div style="margin-top:10% ; text-align: center;;font-family:SFUIText,Helvetica Neue,sans-serif; font-size: 13px;letter-spacing: 1px;">
        <p><a href="https://merimevents-run.com/" target="_blank">Back to home page</a></p><br>
      </div>
    </body>
</html>