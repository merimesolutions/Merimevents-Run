<?php
 include "../connection.php";
$query = mysqli_query($con, "SELECT email FROM users");

if($_GET['q']){
	
	 $how_many = mysqli_num_rows($query);
	 while($emails = mysqli_fetch_assoc($query)){
	 	$email[] = $emails['email'];
	 
   
 }
  $all_emails = implode(',', $email);
echo $all_emails;
 
 
}