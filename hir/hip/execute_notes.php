<?php
session_start();
if (!isset($_SESSION['userid'])){
    require "../redirect.php";
}else{
    $now=time();
    if ($now > $_SESSION['expire']){
        session_destroy();
        require "../redirect.php"; 
    }else{        
    }
}
 
include "connection.php";
	
		
	$note =$_POST['add_note'];
	$cus=$_POST['custom_id'];	
	$addn=mysqli_query($con,"INSERT INTO customer_notes(customer_id,comment_id,note) VALUES ('$cus','$id','$note')");
	if($addn){
		echo'<script>alert("Note Added Succesfully!")</script>';
	}else{
		$erf=mysqli_error($con);
			echo'<script>alert("Error: '."$erf".'")</script>';
	}
	

	
?>
