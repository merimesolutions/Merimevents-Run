 <?php
session_start();
include "../connection.php";

$customer_id = $_GET['id'];
$del_squery=mysqli_query($con, "DELETE FROM tblcustomers WHERE company='".$_SESSION['company']."' AND id='$customer_id' ");
if(!$del_squery){
	$error=mysqli_error($con);
	echo '<script>alert("Cutomer Not Deleted! : '."$error".'");</script>';
}else{
	$msger ='<div class="alert alert-success alert-dismissible" role="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Cusomer Succesfully Deleted!
  
  
</div>';
	header("Location:cl.php");
	
}

												?>
