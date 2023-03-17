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
 $compp=$_SESSION['company'];
 $event_id=$_GET['id'];

	  
	 //Delete the Quotation itself
	  $sql=mysqli_query($con,"DELETE FROM event_quotation WHERE event_id='$event_id'");
	 //Delete any Additional Costs Recorded
	   $sql2=mysqli_query($con,"DELETE FROM additional_costs WHERE event_id='$event_id'");
     //If Quotation had been approved delete Approval status from the database
	  $ref=mysqli_query($con,"DELETE FROM event_quotation_status WHERE event_id ='$event_id' ");
			
//DELETING AN APPROVED QUOTATION
 $squery=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id'");
 if($squery){
     $number =mysqli_num_rows($squery);
 
 if($number > 0){
	 

	 $es=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id' AND quotation_type='Internal' ");
	 if($es){ 
		 $num_tom =mysqli_num_rows($es);
		 if($num_tom > 0){
			
			 //Return Items that had been borrowed from Inventory
			 
			          while($fera = mysqli_fetch_assoc($es)){
             //Get all items;
             $event_item = $fera['event_item'];
             $event_quantity =$fera['event_quantity'];
             
             $wemb =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$event_item'");
             if($wemb){
                 while($tre =mysqli_fetch_assoc($wemb)){
                     $quantity =$tre['qnty'];
                     $new_quantity = $quantity + $event_quantity;
                 }
             }
             //Update inventory with new quantities
             $wed =mysqli_query($con,"UPDATE tblitems SET qnty='$new_quantity' WHERE id='$event_item' AND company='$compp'");
             if(!$wed){
                 $errr =mysqli_error($con);
                 echo '<script>alert("'."$errr".'");</script>';
             }
         }
			 
		 }
	 }
	 	 // Delete it(External Vendors Quotation)
	 
	
    
   
	 
     
 }}
     if($sql && $sql2){
         echo'<script>alert("Quotation succesfully Deleted");window.location="events?id='."$event_id".'"</script>';
     }else{
         $errom =mysqli_error($con);
         echo '<script>alert("'."$errom".' ");window.location="view_event?id='."$event_id".'";</script>';
     }
 
 ?>
