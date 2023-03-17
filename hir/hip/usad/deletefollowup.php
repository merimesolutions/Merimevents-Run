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
$commm=$_SESSION['company'];
$followup_id=$_GET['id'];

$fre=mysqli_query($con,"DELETE FROM followups WHERE id='$followup_id' AND user='$commm'");
if($fre){
	echo'<script>alert("Delete Succesfull!!");window.location="setting.php";</script>';
}else{
	$error_conn=mysqli_error($con);
	echo'<script>alert("Error: '."$error_conn".'");window.location="setting.php";</script>';
}
     
 
  ?>
