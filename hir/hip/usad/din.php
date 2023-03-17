<?php

// include("'hir\hip\connection.php");
// include_once 'hir\hip\connection.php';
if (isset($_POST['submit'])) {
  $con = mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event');
  if (!$con) {
    die("Connection Error:" . mysqli_connect_error());
  }
  $name = $_POST['full_name'];
  $pnum = $_POST['contact'];
  $email = $_POST['email'];
  $company = $_POST['company'];
  $location = $_POST['location'];
  $date = $_POST['date'];
  $comment = $_POST['comment'];
  $query = mysqli_query($con, "INSERT INTO tbldemo (full_name,phone_number,email,company,location,date,comment) VALUES('$name','$pnum','$email','$company','$location','$date','$comment')");
  if ($query) {
    echo 'Recorded';
  }
  else {
    echo 'Not Recorded' . mysqli_error($con);
  }
  $emailErr = '';
  //Validate Email
  // $contact_mail = trim($_POST['email']);
  // if (!filter_var($contact_mail, FILTER_VALIDATE_EMAIL)) {
  //  $emailErr = "Invalid email format";
  // } 
  // if(empty($emailErr)){

  $mail = 'tryer@merimevents-run.com';
  $email_from = $email; // sender address
  $email_subject = "INQUIRY: Demo Request";
  $email_body = "Dear Merimevents-run $name left you the following message:,\n $comment\n
    " .
    $to = "To: $mail"; // receiving addresss
  $headers = "From: $email_from \r\n";
  $headers .= "Reply-To: $email \r\n";
  //Send the email!
  $y = mail($to, $email_subject, $email_body, $headers);

  if ($y) {
    echo '<script>alert("Your Message has been succesfully sent to LinknaMali help center.A reply will be sent to you as soon as possible");window.location = "index.php";</script>';  //  echo '<script type="text/javascript">'; 
//     echo 'alert("Your Message has been sent to LinknaMali help center.A reply will be sent to you as soon as possible.");'; 
//     echo 'window.location = "#";';
//     echo '</script>';
  }
  // }  
  else {
    echo '<script>alert("An error occured during submission: ' . "emailErr" . ' ");</script>';  // 	 echo '<script type="text/javascript">'; 
//     echo 'alert("An Error occured during submision:'."$emailErr".'");'; 
//     echo 'window.location = "#";';
//     echo '</script>'; 
  }

}

?>