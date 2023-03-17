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
 $squery=mysqli_query($con,"SELECT * FROM event_quotation_status WHERE event_id='$event_id'");
 if($squery){
     $number =mysqli_num_rows($squery);
    
 
 if($number > 0){
     echo '<script>alert("This quotation had already been previously approved!");window.location="view_event?id='."$event_id".'";</script>';
 }
 }
 $mez =mysqli_query($con, "SELECT * FROM event_quotation WHERE event_id='$event_id'");
$upd=mysqli_query($con,"UPDATE event_quotation SET quotation_status ='Approved' WHERE event_id='$event_id'");
 //Check if the items needed for the event are available in the stock else quotation cannot be approved.
 while($roz =mysqli_fetch_array($mez)){
     $item_required =$roz['event_item'];
     $variabley =$roz['event_quantity'];
     $variable=(float)$variabley;
       $ddd =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$item_required' AND company='$compp'");
                                        while($hd = mysqli_fetch_array($ddd)){
                                            $get_quantityz =$hd['qnty'];
                                            $get_quantity =(float)$get_quantityz;
                                            $get_name=$hd['item_name'];
                                        }
                                                // if($variable > $get_quantity){
                                                //     echo '<script>alert("STOCK ALERT : The '."$variable".'  '."$get_name".' requested exceeds the available '."$get_quantity".' present and the quotation can therefore not be approved.");window.location="view_event.php?id='."$event_id".'"</script>';
                                                // }elseif($variable <= $get_quantity){
 
 
 
     $sql=mysqli_query($con,"INSERT INTO event_quotation_status(event_id,quotation_status,company) VALUES('$event_id',1,'$compp')");
     if($sql){
         //Removing items from the inventory//
         
         $f=mysqli_query($con,"SELECT * FROM event_quotation WHERE event_id='$event_id' AND quotation_type='Internal'");
         while($fera = mysqli_fetch_array($f)){
             //Get all items;
             $event_item = $fera['event_item'];
             $event_quantity =$fera['event_quantity'];
		 
             $wemb =mysqli_query($con,"SELECT * FROM tblitems WHERE id='$event_item'");
             
                 while($tre =mysqli_fetch_array($wemb)){
                     $quantity =$tre['qnty'];
					 $tota= $tre['new_total'];
					 if(!empty($tota)){
                     $new_quantity = $tota - $event_quantity;
					 }elseif(empty($tota)){
					  $new_quantity =$quantity - $event_quantity;
						  
					 }
					 
					 //Record the number of items leased out
               $wed =mysqli_query($con,"UPDATE tblitems SET leased_events='$quantity', new_total ='$new_quantity' WHERE id='$event_item' AND company='$compp'");
                if(!$wed){
                 $errr =mysqli_error($con);
                 echo '<script>alert("Error: '."$errr".'");</script>';
                   }
				 }
			
                 
             
		 }
             
     
         
         echo '<script>alert("Quotation succesfully Approved");window.location="view_event?id='."$event_id".'";</script>';
     }else{
         $error =mysqli_error($con);
           echo '<script>alert(" '."$error".'");window.location="view_event?id='."$event_id".'";</script>';
     }
// }
 }
 ?>
