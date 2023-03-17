<!DOCTYPE html>
<html style="background-color:#ECF0F1; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;overflow-y: hidden;overflow-x: hidden;">
<style type="text/css">
    body{ font: 14px sans-serif; }
    p a{color:#000;}
    .icon{
            width: 35px;
            padding-right: 10px;
        }
    .iconb{
            width: 40px;
            padding-right: 10px;
        }
        .icon:hover{
            transition: 0.3s;
        }
  </style>
    <head>
        <meta charset="UTF-8">
        <title>Merime | Event-run</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="hir/images/fire.png" type="image/x-icon">
        <!-- bootstrap 3.0.2 -->
        <link href="hir/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <!--link href="css/AdminLTE.css" rel="stylesheet" type="text/css" /-->
        <link href="hir/css/css.css" rel="stylesheet" type="text/css" />


    </head>
    <body class="skin-black" style="background-color: transparent; font-family: arial">
        <?php
                function RandomString($length) {
                    $keys = array_merge(range(0,9));
                        $key = "";
                        for($i=0; $i < $length; $i++) {
                        $key .= $keys[mt_rand(0, count($keys) - 1)];
                    }
                        return $key;               
                }
            ?>
          <div style="margin-top:5%;" class="container">

          <div class="col-md-6 col-md-offset-3 ">
              <center style="font-family: cursive; font-size: 20px;">  
                <!--?php
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
              ?--></center>
            <br>
              <div class="panel">
            <div class="panel-heading">
              <h1 class="panel-title" >
              <center style="font-family:Sans-serif;font-size: 24px;letter-spacing: 5px;">Request<span style="font-weight: bolder;">Password</span>
              </center>
            </h1>
            </div>
            <div class="panel-body">
              <form role="form" action="hir/reset-frac.php" method="post">
                <p>Provide your username & tel / Mobile number used.</p><br>
                <div class="form-group">
                  <input type="text" name="username" placeholder="Enter your username" autocomplete="off" required="">
                </div>
                <div class="form-group">
                  <input type="text" name="contact" placeholder="Enter Tel / Mobile number used" autocomplete="off" maxlength="13" required="">
                </div>
                <input type="text" name="pass" value="<?php echo RandomString(8); ?>"/>
                <button type="submit" class="btn btn-sm btn-success" name="submit" title="Click to login" style="width:">Request</button>
                <a href="https://merimevents-run.com/free-trial.php" style="float: right;padding: 5px"> Go home</a>
              </form><br>
              <p>Customer care</p>
              <a href="https://api.whatsapp.com/send?phone=+254757414345" target="_blank">
                  <img src="hir/images/icons/whatsapp.png" title="Whatsapp us" class="iconb" alt="Whatsapp">
              </a>      
              <a href="mailto:contactus@merimesolutions.com?subject=" target="_blank">
                  <img src="hir/images/icons/mail.png" title="Mail us" class="icon" alt="Mail">
              </a>
              <a href="https://www.merimesolutions.com/" target="_blank">
                  <img src="hir/images/icons/website.png" title="Find our website" class="icon" alt="Our website">
              </a>
            </div>
          </div>          
          </div>
          
        </div>
         <!--div class="cloud x4"></div-->
</div> 
    </div>
      <div style="margin-top:2% ; text-align: center;;font-family:SFUIText,Helvetica Neue,sans-serif; font-size: 13px;letter-spacing: 1px;">
        <p><a href="#"  style="margin-right: 15px">About</a><a href="#" style="margin-right: 15px">Policies</a><a href="#" style="margin-right: 15px">Copyright<span>&#169;</span></a><a href="http://merimesolutions.com/contact.html" target="_blank">Help?</a></p><br>
      </div>
    </body>
</html>