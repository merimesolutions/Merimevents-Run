<?php 
//Create a conection with database
$con =  mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die("connection failed" . mysqli_error()); 

//Set Variebles for the input
$username = $_POST['username'];
$contact = $_POST['contact'];

// Send information as email to user
if($_POST['submit'])
{


//Validate first
/*if(empty($username)||empty($contact)) 
{
    echo "All fields are mandatory!";
    exit;
}*/


$query = mysqli_query($con,"SELECT username, contact, email,password,full_name from tblstaff where username='".$username."' and contact = '".$contact."'");
        while($row = mysqli_fetch_array($query))                                 {
           $pass=$row['password'];
           $mail=$row['email'];
           $full_name= ucwords($row['full_name']);
           $user=$row['username'];
        }
        if($query == true){
    echo '<script type="text/javascript">'; 
   echo 'alert("Request is successfull. An email has been sent to your email.");'; 
    echo 'window.location = "https://merimevents-run.com/hir/login.php";';
    echo '</script>';
        }
$email_from = 'info@merimevents-run.com';   // sender address
$email_subject = "PASSWORD REQUEST";
$email_body = "Dear $full_name,\nYour password request was succefull. Use the below credentials
        USERNAME: $user
        PASSWORD: $pass
Do not share your password.\nClick the link to login: https://merimevents-run.com/hir/login.php\n\n\n\n\n ".
    
$to = "To:$mail";// receiving addresss
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
}
?>