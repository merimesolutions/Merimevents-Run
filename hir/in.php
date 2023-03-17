<?php 
//Create a conection with database
$con =  mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die("connection failed" . mysqli_error()); 

//Set Variebles for the input
$full_name = ucwords($_POST['full_name']);
$company = $_POST['company'];
$location = $_POST['location'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$otp = $_POST['otp'];
$contact = $_POST['contact'];
$username = $_POST['full_name'];
$acc = "admin";
$package= $_POST['package'];
$recaptcha = $_POST['g-recaptcha-response'];
$secret_key = '6LcWLecfAAAAAJ5XiF2DgUdyHkG4ZkYhr4ACet5B';
$url = 'https://www.google.com/recaptcha/api/siteverify?secret='
		. $secret_key . '&response=' . $recaptcha;
$response = file_get_contents($url);
$response=json_decode($response);
if ($response->success == true){
  echo '<script>alert("Google reCAPTCHA verified")</script>';
}
else{
  echo '<script>alert("Error in Google reCAPTACHA");window.location="free-trial"</script>';
}
$status= "active";
$date=date("Y-m-d");


// Send information as email to user
/*if($_GET["register"]) {
    //This page should not be accessed directly. Need to submit the form.
    echo "error; you need to submit the form!";
}*/

$sql_u = "SELECT * FROM tblstaff WHERE email = '$email'";
        $results = mysqli_query($con,$sql_u);
        if(mysqli_num_rows($results)>0)
        {
        echo '<script type="text/javascript">'; 
        echo 'alert("The email is already registered.");'; 
        echo 'window.location = "register.php";';
        echo '</script>';
        exit; 
    }else{
        //Create a MySQL command to INSERT data into data table
$sql = "INSERT INTO tblstaff(full_name,companyname,location,email, contact,username,accounttype,company,package,reg_date,otp) VALUES ('$full_name','$company','$location','$email','$contact','$username','$acc','$pass','$package','$date','$otp')";
$sqluser = "INSERT INTO tblusers(username,full_name,company) VALUES ('$username','$full_name','$pass')";
if (mysqli_query($con, $sqluser)) {
}
//Now Insert data into database
//Check if data is inserted or not
if (!mysqli_query($con, $sql)) {
    $error=mysqli_error($con);
    echo '<script type="text/javascript">'; 
    echo 'alert("error occured during submision:'."$error".'");'; 
    echo 'window.location = "register.php";';
    echo '</script>';

} else{
    echo '<script type="text/javascript">'; 
    echo 'alert("Registered successfully. A email verification link has been sent to your email.");'; 
    echo 'window.location = "login.php";';
    echo '</script>';



$email_from = 'help@merimevents-run.com';   // sender address
$email_subject = "MERIME EVENTS-RUN ACCOUNT REGISTRATION";
$email_body = "Dear $full_name,\nThank you for registering with us.\nUse One Time Password OTP below to create your password\n
===========================================\n
OTP: $pass\n
===========================================\n
Click the link below to create your login credentials:\n
    https://merimevents-run.com/new.php\n\n\n ".
"Merime Events-run helps you manage items or anything you hire out. It has projects module to help with events management; create an event as a project, break it down to tasks and assign them to your team with deadlines.
The system can manage Inventory, Invoices, Payments, Hiring/Leasing and Returning items, Projects, and generates reports that are printable both in excel and PDF. If you hire Items or plan events, Merime Events-run is your ultimate partner in making it all easy.
Whether it's a wedding or birthday party or whatever event you're organizing, Merime Events-run makes is your partner in making your planning easy.\n".
    
$to = "To: $email";// receiving addresss
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
}




?>