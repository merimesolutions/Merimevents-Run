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
 }
 if($number > 0){
     echo '<script>alert("This quotation had already been previously approved and can therefore not be deleted!");window.location="view_event.php?id='."$event_id".'";</script>';
 }else{
     $sql=mysqli_query($con,"DELETE FROM event_quotation WHERE event_id='$event_id'");
     $sql2=mysqli_query($con,"DELETE FROM additional_costs WHERE event_id='$event_id'");
     if($sql && $sql2){
         echo'<script>alert("Quotation succesfully Deleted");window.location="view_event.php?id='."$event_id".'"</script>';
     }else{
         $errom =mysqli_error($con);
         echo '<script>alert("'."$errom".' ");window.location="view_event.php?id='."$event_id".'";</script>';
     }
 }
 ?>