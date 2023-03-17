<?php
$con =  mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die("connection failed" . mysqli_error()); 

    if(isset($_POST['btn_login']))
        {
        //the path to store the submited image
      $password = $_POST['password'];
      $pass = $_POST['pass'];
      $otp = $_POST['otp'];
      $ops = '1';
      
      if(($password)!=($pass)){
          echo '<script type="text/javascript">'; 
                    echo 'alert("Password does not match.");'; 
                    echo 'window.location = "new.php";';
                    echo '</script>';
      }else{
          
      $sql_u = mysqli_query($con,"SELECT otp from tblstaff where otp!='1' ");
        if($row=mysqli_num_rows($sql_u)>0){
      
      $query = mysqli_query($con,"UPDATE tblstaff SET password = '".$password."', otp = '".$ops."',temp_status='active' where otp = '".$otp."' ");
            if($query == true){
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Password created successfully.");'; 
                    echo 'window.location = "free-trial.php";';
                    echo '</script>';
                        }else{
                          echo '<script type="text/javascript">'; 
                    echo 'alert("Something wrong happened.");'; 
                    echo 'window.location = "free-trial.php";';
                    echo '</script>';  
                        }
                        }else{
                    echo '<script type="text/javascript">'; 
                    echo 'alert("OTP already expired.");'; 
                    echo 'window.location = "free-trial.php";';
                    echo '</script>';  
                        }
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
        <title>Merime Events-run</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="images/fire.png" type="image/x-icon">
        <!-- bootstrap 3.0.2 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

        <!-- Theme style -->


    </head>
    <body class="skin-black" style="background-color: transparent; font-family: arial;">
        <center>
          <div style="margin-top:6%;" class="container">

          <div class="col-md-4 col-md-offset-4 ">
              <center style="font-family: cursive; font-size: 20px;">  
               Merime Events-run</center>
            <br>
              <div class="panel">
            <div class="panel-heading">
              <h1 class="panel-title" >
              <center style="font-family:Sans-serif;font-size: 24px;letter-spacing: 5px;">Create<span style="font-weight: bolder;">Password</span>
              </center>
            </h1>
            </div>
            <div class="panel-body">
              <form role="form" method="post">
                  <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping" style="width:150px">OTP</span>
                      <input type="text" name="otp" class="form-control" placeholder="One Time Password" aria-label="Username" aria-describedby="addon-wrapping" autocomplete="off" maxlength="6" minlength="6">
                  </div>
                  <br>
                  <div class="input-group flex-nowrap">
                      <span  style="width:150px" class="input-group-text" id="addon-wrapping">New Password</span>
                      <input type="password" name="password" class="form-control" placeholder="*********" aria-label="Password" aria-describedby="addon-wrapping" autocomplete="off" minlength="8">
                  </div>
                  <br>
                  <div class="input-group flex-nowrap">
                      <span  style="width:150px" class="input-group-text" id="addon-wrapping">Confirm Password</span>
                      <input type="password" name="pass" class="form-control" placeholder="*********" aria-label="Password" aria-describedby="addon-wrapping" autocomplete="off">
                  </div><br>
                <button type="submit" class="btn btn-sm btn-success" name="btn_login" title="Click to login" style="width:45%">Submit</button>
                
              </form>
            </div>
          </div>
          
          </div>
          
        </div>
        </center>
</div> 
    </div>
    </body>
</html>