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
 include "../connection.php";
if(isset($_POST['submitformz'])){
	$creation_date = $_POST['l_date'];
	$expiration_date =$_POST['expiry_date'];
	$quot_status =$_POST['quotation_status'];
	$event_id=$_POST['event_id'];
	$queryy=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id'");
if($queryy){
	$no_rowsz=mysqli_num_rows($queryy);
	if($no_rowsz < 1){
		echo '<script>alert("Select items from Inventory!");window.location="add-quotation?id='."$event_id".'";</script>';
	}else{
	$sqll=mysqli_query($con,"UPDATE event_quotation SET creation_date='$creation_date',expiry_date='$expiration_date',quotation_status='$quot_status' WHERE event_id='$event_id' ");
	if($sqll){
		echo '<script>window.location="view_event?id='."$event_id".' ";</script>';
	}else{
		$resno =mysqli_error($con);
		echo '<script>alert("Error: '."$resno".'");window.location="add-quotation?id='."$event_id".'";</script>';
	}	
	}

}
}
?>
